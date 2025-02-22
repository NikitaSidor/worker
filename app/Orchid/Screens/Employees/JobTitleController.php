<?php

namespace App\Orchid\Screens\Employees;

use App\Http\Requests\Employees\JobTitleRequest;
use App\Models\JobTitle;
use App\Orchid\Layouts\Employees\CreateOrUpdateJobTitle;
use App\Orchid\Layouts\Employees\JobTitleListLayout;
use App\Models\User;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;

class JobTitleController extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'job_titles' => JobTitle::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'JobTitle';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "JobTitle";
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
                ->modalTitle("Добавление профессии")
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
            JobTitleListLayout::class,
            Layout::modal('saveJobTitle', CreateOrUpdateJobTitle::class)
                ->closeButton('Close')
                ->applyButton('Сохранить'),

            Layout::modal('editJobTitle', CreateOrUpdateJobTitle::class)
                ->async('asyncGetJobTitles')
                ->closeButton('Закрыть')
                ->applyButton('Изменить'),
        ];
    }
    public function asyncGetJobTitles(JobTitle $jobTitle) :array {
        return [
            'job_title' => $jobTitle
        ];
    }

    public function create(JobTitleRequest $request) :void {
        JobTitle::create($request->validated()['job_title']);
        Toast::info('JobTitle create');
    }
    public function update(JobTitleRequest $request) :void {
        $validatedData = $request->validated()['job_title'];
        $jobTitle = JobTitle::find($validatedData['id']);
        $jobTitle->update([
            'name' => $validatedData['name'],
            'supervisor' => $validatedData['supervisor'],
        ]);
    }

    public function delete(Request $request) : void {
        Toast::info('JobTitle delete');
        $jobTitle = JobTitle::findOrFail($request->id);
        $jobTitle->delete();
        Toast::info('JobTitle deleted');
    }
}
