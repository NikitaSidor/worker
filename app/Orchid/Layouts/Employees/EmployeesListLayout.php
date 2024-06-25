<?php

namespace App\Orchid\Layouts\Employees;

use App\Models\Employees;
use App\Models\JobTitle;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EmployeesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'employees';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', '№'),
            TD::make('user_id', 'user_id')->defaultHidden(),
            TD::make('user.name', 'User Name')->render(function ($employee) {
                // Используем optional() для безопасного доступа к свойству name
                return optional($employee->user)->name;
            })->sort(),
            TD::make('job_title_id', 'job_title_id')->defaultHidden(),
            TD::make('job_title.name', 'Job Title')->render(function ($employee) {
                // Используем optional() для безопасного доступа к свойству name
                return optional($employee->jobTitle)->name;
            })->sort(),
            TD::make('department_id', 'department_id')->defaultHidden(),
            TD::make('department.name', 'Department')->render(function ($employee) {
                // Используем optional() для безопасного доступа к свойству name
                return optional($employee->department)->name;
            })->sort(),
            TD::make('salary', 'salary'),
            TD::make('currency', 'currency'),

            TD::make('employment_under', 'employment_under')->defaultHidden(),
            TD::make('employment_under', 'Employment Status')->render(function ($employee) {
                return $employee->employment_under_text; // Use the accessor here
            }),

            TD::make('')->width(20)->render(function(Employees $employees) {
                return ModalToggle::make('')
                    ->icon('pencil')  // Sets the icon of the toggle button to a pencil (edit icon)
                    ->modal('editEmployees')  // Sets the modal identifier as 'editJobTitle'
                    ->method('update')  // Specifies that the method to be called is 'update'
                    ->modalTitle('Редактировать ' . $employees->name)  // Sets the modal title to 'Редактировать профессию' (Edit job title)
                    ->asyncParameters([
                        'employees' => $employees->id  // Passes async parameters, including the job title ID
                    ]);
            }),
            TD::make('')->width(20)->render(function(Employees $employees) {
                return Button::make('')
                    ->icon('trash')  // Sets the icon of the button to a trash icon (delete)
                    ->confirm('Are you sure you want to delete this employees?')  // Confirmation message for delete action
                    ->method('employees')  // Specifies that the button triggers a 'delete' action
                    ->parameters(['id' => $employees->id]);  // Passes parameters, including the job title ID
            })
        ];
    }
}
