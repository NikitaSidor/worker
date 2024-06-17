<?php

namespace App\Orchid\Screens\Employees;

use App\Orchid\Layouts\Employees\EmployeesListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use App\Models\Employees;

class EmployeesController extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'employees' => Employees::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Employees';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Employees";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('JobTitle')->href('employees/job'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            EmployeesListLayout::class,
        ];
    }
}
