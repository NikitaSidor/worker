<?php

namespace App\Orchid\Layouts\Employees;

use App\Models\Department;
use App\Models\Employees;
use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class CreateOrUpdateDepartment extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
//        name
//parent_department_id
//manager_id
        return [
            Input::make('department.id')->type('hidden'),
            Input::make('department.name')->title('Job Title')->required(),
            Select::make('department.parent_department_id')
                ->title('parent department id')
                ->fromModel(Department::class, 'name')
                ->empty('No select'),
            Select::make('department.manager_id')
                ->title('Manager id')
                ->fromModel(Employees::class, 'name')
                ->empty('No select')
        ];
    }
}
