<?php

namespace App\Orchid\Layouts\Employees;

use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class CreateOrUpdateJobTitle extends Rows
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
            Input::make('job_title.id')->type('hidden'),
            Input::make('job_title.name')->title('Job Title')->required(),
            Select::make('job_title.supervisor')
                ->title('Supervisor')
                ->fromModel(User::class, 'name')
                ->empty('No select')
        ];
    }
}
