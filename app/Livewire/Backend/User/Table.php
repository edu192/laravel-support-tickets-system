<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
        return User::query()->with('department');
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
            ->add('name')
            ->add('email')
            ->add('type', function ($row) {
                $type = match ($row->type) {
                    0 => 'Admin',
                    1 => 'Customer',
                    2 => 'Employee',
                    default => 'Customer',
                };
                return $type;
            })
            ->add('department_id')
            ->add('department_formatted', function ($row) {
                if (empty($row->department))
                {
                    return '<span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Unassigned</span>';
                }
                return '<span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">'.$row->department?->name.'</span>' ;
            })
            ->add('phone')
            ->add('address')
            ->add('department');
    }

    public function columns()
    : array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('Department', 'department_formatted', 'department_id')
                ->sortable()
                ->searchable(),
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

    public function actions(User $row)
    : array
    {
        return [
            Button::add('custom')
                ->render(function (User $user) {
                    return \Blade::render(<<<HTML
                    <div class="flex items-center justify-center">
                        <button type="button" onclick="Livewire.dispatch('openModal', { component: 'backend.user.view-modal', arguments:{ user: $user->id  }})"
                         class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            View
                        </button>
                    
                        <button type="button" onclick="Livewire.dispatch('openModal', { component: 'backend.user.edit-modal', arguments:{ user: $user->id  }})"
                         class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            Edit
                        </button>
                        
                        <button type="button" onclick="Livewire.dispatch('openModal', { component: 'backend.user.delete-modal', arguments:{ userId: $user->id  }})"
                             class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
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
