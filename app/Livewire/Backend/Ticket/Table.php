<?php

namespace App\Livewire\Backend\Ticket;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class Table extends PowerGridComponent
{
    use WithExport;

    public function setUp()
    : array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource()
    : Builder
    {
        return Ticket::query();
    }

    public function relationSearch()
    : array
    {
        return [];
    }

    public function fields()
    : PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('status', function ($row) {
                return match ($row->status) {
                    0 => \Blade::render(
                        <<<HTML
                                <x-badge color="green" text="Open" />
                            HTML
                    ),
                    2 => \Blade::render(
                        <<<HTML
                                <x-badge color="red" text="Closed" />
                            HTML
                    ),
                    1 => \Blade::render(
                        <<<HTML
                                <x-badge color="yellow" text="In progress" />
                            HTML
                    ),
                    default => \Blade::render(

                        <<<HTML
                         <x-badge color="red" text="$row->status" />
                    HTML

                    ),
                };
            })
            ->add('assign_status', function ($row) {
                $assign_status =$row->assigned_agent->count()>0 ? 'Assigned' : 'Unassigned';
                return '<span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">'.$assign_status.'</span>';
            })
            ->add('priority', function ($row) {
                $priority = match ($row->priority) {
                    0 => 'Low',
                    1 => 'Medium',
                    2 => 'High',
                    default => 'Unknown',
                };
                return '<span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">' . $priority . '</span>';
            })
            ->add('category_id', function ($row) {
                return $row->category->name;
            })
            ->add('assigned_to', function ($row) {
                $html = '';
                if (empty($row->assigned_agent)) {
                    return '<span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Unassigned</span>';
                } else {
                    foreach ($row->assigned_agent as $agent) {
                        $html .= '<span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">' . $agent->name . '</span>';
                    }
                }
                return $html;
            })
            ->add('updated_at')
            ->add('updated_at_formatted', function ($row) {
                return Carbon::parse($row->updated_at)->diffForHumans();
            });
    }

    public function columns()
    : array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),


            Column::make('Priority', 'priority')
                ->sortable()
                ->searchable(),
            Column::make('Category', 'category_id'),
            Column::make('Last update', 'updated_at_formatted', 'updated_at')
                ->sortable(),
            Column::make('Status', 'status')
                ->sortable(),
            Column::make('Assigned', 'assign_status'),

//            Column::make('Assigned to', 'assigned_to'),


            Column::action('Action')
        ];
    }

    public function filters()
    : array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId)
    : void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Ticket $row)
    : array
    {
        return [
            Button::add('custom')
                ->render(function (Ticket $ticket) {
                    return \Blade::render(<<<HTML
                    <div class="flex items-center justify-center">
                        
                        <button onclick="Livewire.dispatch('openModal', { component: 'backend.ticket.view-modal', arguments: { ticket: {{ $ticket->id }} }})"
                         class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            View
                        </button>
                        @if(auth()->user()->type == '0')
                         <button onclick="Livewire.dispatch('openModal', { component: 'backend.ticket.assign-agent-modal', arguments: { ticket: {{ $ticket->id }} }})"
                         class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            Assign
                        </button>
                        <form action="">
                            <button type="button" onclick="Livewire.dispatch('openModal', { component: 'frontend.ticket.delete-modal', arguments: { rowId: {{ $ticket->id }} }})"
                             class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                        </form>
                        @endif
                    </div>
                    HTML
                    );
                }),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
