<?php

namespace App\Orchid\Layouts\Employees;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DepartmentListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'departments';

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
            TD::make('parent_department_id', 'supervisor'),
            TD::make('manager_id', 'manager_id'),
            TD::make('created_at', 'created_at'),
            TD::make('updated_at', 'updated_at'),
        ];
    }
}
