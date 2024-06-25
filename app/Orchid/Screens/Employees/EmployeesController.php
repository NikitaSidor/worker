<?php

namespace App\Orchid\Screens\Employees;

use App\Models\JobTitle;
use App\Orchid\Layouts\Employees\CreateOrUpdateEmployees;
use App\Http\Requests\Employees\EmployeesRequest;
use App\Orchid\Layouts\Employees\EmployeesListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use App\Models\Employees;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

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
            Link::make('JobTitle')->route('job.title'),
            Link::make('Department')->route('job.department'),

            ModalToggle::make('Добавить')
                ->modalTitle("Добавление профессии")
                ->icon('plus-alt')
                ->modal('saveEmployees')
                ->method('create')
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

            Layout::modal('saveEmployees', CreateOrUpdateEmployees::class)
                ->closeButton('Close')
                ->applyButton('Сохранить'),

            Layout::modal('editEmployees', CreateOrUpdateEmployees::class)
                ->async('asyncGetEmployees')
                ->closeButton('Закрыть')
                ->applyButton('Изменить'),
        ];
    }

    public function asyncGetEmployees(Employees $employees) :array {
        return [
            'employee' => $employees
        ];
    }
    public function create(EmployeesRequest $request) :void {
        Employees::create($request->validated()['employee']);
        Toast::info('Employee create');
    }

    public function update(EmployeesRequest $request) :void {
        $validatedData = $request->validated()['employee'];
        $employees = Employees::find($validatedData['id']);
        $employees->update([
            'name' => $validatedData['name'],
            'supervisor' => $validatedData['supervisor'],
        ]);
    }

    public function delete(Request $request) : void {
        Toast::info('JobTitle delete');
        $employees = Employees::findOrFail($request->id);
        $employees->delete();
        Toast::info('JobTitle deleted');
    }
}
