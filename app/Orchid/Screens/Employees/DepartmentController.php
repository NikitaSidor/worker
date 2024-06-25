<?php

namespace App\Orchid\Screens\Employees;

use App\Http\Requests\Employees\JobTitleRequest;
use App\Models\Department;
use App\Models\JobTitle;
use App\Orchid\Layouts\Employees\CreateOrUpdateDepartment;
use App\Orchid\Layouts\Employees\DepartmentListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DepartmentController extends Screen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'departments' => Department::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Department';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Department";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить')
                ->modalTitle("Добавление департамент")
                ->icon('plus-alt')
                ->modal('saveJobTitle')
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
            DepartmentListLayout::class,
            Layout::modal('saveJobTitle', CreateOrUpdateDepartment::class)
                ->closeButton('Close')
                ->applyButton('Сохранить'),

            Layout::modal('editJobTitle', CreateOrUpdateDepartment::class)
                ->async('asyncGetJobTitles')
                ->closeButton('Закрыть')
                ->applyButton('Изменить'),
        ];
    }
    public function asyncGetJobTitles(Department $department) :array {
        return [
            'department' => $department
        ];
    }

    public function create(JobTitleRequest $request) :void {
        JobTitle::create($request->validated()['department']);
        Toast::info('JobTitle create');
    }
    public function update(JobTitleRequest $request) :void {
        $validatedData = $request->validated()['department'];
        $jobTitle = JobTitle::find($validatedData['id']);
        $jobTitle->update([
            'name' => $validatedData['name']
        ]);
    }

    public function delete(Request $request) : void {
        Toast::info('Department delete');
        $jobTitle = JobTitle::findOrFail($request->id);
        $jobTitle->delete();
        Toast::info('Department deleted');
    }
}
