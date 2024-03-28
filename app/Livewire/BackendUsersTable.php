<?php

namespace App\Livewire;

use App\Models\User;
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

final class BackendUsersTable extends PowerGridComponent
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
            ->add('phone')
            ->add('address')
            ->add('department', function ($row) {
                return $row->department?->name;
            });
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

            Column::make('Department', 'department_id'),
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
                        <button type="button" onclick="Livewire.dispatch('openModal', { component: 'backend.user-view-modal', arguments:{ user: $user->id  }})"
                         class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            View
                        </button>
                    
                        <button type="button" onclick="Livewire.dispatch('openModal', { component: 'backend.user-edit-modal', arguments:{ user: $user->id  }})"
                         class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            Edit
                        </button>
                        
                        <button type="button" 
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
