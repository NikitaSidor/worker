<?php

namespace App\Orchid\Layouts\Employees;

use App\Models\Department;
use App\Models\JobTitle;
use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;

class CreateOrUpdateEmployees extends Rows
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
        return [
            Input::make('employee.id')->type('hidden'),

            Select::make('employee.user_id')
                ->title('User Name')
                ->fromModel(User::class, 'name')
                ->empty('No select')
                ->disabled($this->query->getContent('employee.user_id')!==null),

            Group::make([
                Select::make('employee.job_title_id')
                    ->title('Job Title')
                    ->fromModel(JobTitle::class, 'name')
                    ->empty('No select'),
                Select::make('employee.department_id')
                    ->title('Department')
                    ->fromModel(Department::class, 'name')
                    ->empty('No select'),
            ]),
            Group::make([
                Input::make('employee.salary')->title('Salary')->required(),
                Input::make('employee.currency')->title('Currency')->required(),
            ])
        ];
    }
}
