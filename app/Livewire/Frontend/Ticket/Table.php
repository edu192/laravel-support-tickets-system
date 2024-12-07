<?php

namespace App\Livewire\Frontend\Ticket;

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

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('exportar')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Ticket::query()->with('category')->where('user_id', auth()->id())->where('status', '!=', 2);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('status', function ($row) {
                return match ($row->status) {
                    0 => \Blade::render(
                        <<<HTML
                                <x-badge color="green" text="Abierto" />
                            HTML
                    ),
                    2 => \Blade::render(
                        <<<HTML
                                <x-badge color="red" text="Cerrado" />
                            HTML
                    ),
                    1 => \Blade::render(
                        <<<HTML
                                <x-badge color="yellow" text="En progreso" />
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
                    0 => 'Baja',
                    1 => 'Media',
                    2 => 'Alta',
                    default => 'Desconocida',
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

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Título', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'status')
                ->sortable()
                ->searchable(),
            Column::make('Última actualización', 'updated_at_formatted')
                ->sortable(),

            Column::make('Prioridad', 'priority')
                ->sortable()
                ->searchable(),

            Column::make('Categoría', 'category_id'),

            Column::action('Acción')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Ticket $row): array
    {
        return [
            Button::add('custom')
                ->render(function (Ticket $ticket) {
                    return \Blade::render(<<<HTML
                    <div class="flex items-center justify-center">
                        <a href="{{ route('user.ticket.show', $ticket->id) }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Ver</a>
                        @if($ticket->status==0)
                            <button type="button" onclick="Livewire.dispatch('openModal', { component: 'frontend.ticket.delete-modal', arguments: { rowId: {{ $ticket->id }} }})"
                             class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
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
            // Ocultar botón de edición para ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
