<?php

namespace App\Orchid\Layouts\Employees;

use App\Models\JobTitle;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\ModalToggle;

class JobTitleListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'job_titles';
    // 'name_column'=>'value'
    protected $column = [];


    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', '№'),
            TD::make('name', 'name'),
            TD::make('supervisor', 'supervisor'),
            TD::make('created_at', 'created_at'),
            TD::make('updated_at', 'updated_at'),
            TD::make('')->width(20)->render(function(JobTitle $jobTitle) {
                return ModalToggle::make('')
                        ->icon('pencil')  // Sets the icon of the toggle button to a pencil (edit icon)
                        ->modal('editJobTitle')  // Sets the modal identifier as 'editJobTitle'
                        ->method('update')  // Specifies that the method to be called is 'update'
                        ->modalTitle('Редактировать профессию')  // Sets the modal title to 'Редактировать профессию' (Edit job title)
                        ->asyncParameters([
                            'jobTitle' => $jobTitle->id  // Passes async parameters, including the job title ID
                        ]);
            }),
            TD::make('')->width(20)->render(function(JobTitle $jobTitle) {
                return Button::make('')
                    ->icon('trash')  // Sets the icon of the button to a trash icon (delete)
                    ->confirm('Are you sure you want to delete this job title?')  // Confirmation message for delete action
                    ->method('delete')  // Specifies that the button triggers a 'delete' action
                    ->parameters(['id' => $jobTitle->id]);  // Passes parameters, including the job title ID
            })
        ];
    }
}
