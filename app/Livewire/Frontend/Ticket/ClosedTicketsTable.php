<?php

namespace App\Livewire\Frontend\Ticket;

use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ClosedTicketsTable extends PowerGridComponent
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
        return Ticket::query()->with('category')->where('user_id', auth()->id())->where('status', 2);
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


            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),
            Column::make('Last update', 'updated_at_formatted')
                ->sortable(),

            Column::make('Priority', 'priority')
                ->sortable()
                ->searchable(),

            Column::make('Category id', 'category_id'),


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
                        <a href="{{ route('user.ticket.show', $ticket->id) }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">View</a>
                        @if($ticket->status==0)
                            <button type="button" onclick="Livewire.dispatch('openModal', { component: 'frontend.ticket.delete-modal', arguments: { rowId: {{ $ticket->id }} }})"
                             class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                        @endcan
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
