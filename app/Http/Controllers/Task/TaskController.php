<?php

namespace App\Http\Controllers\Task;

use App\Http\Requests\Task\EditTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Services\Action\Task\EditTaskAction;
use App\Services\Action\Task\StoreTaskAction;
use App\Services\Action\Task\UpdateTaskAction;
use App\Services\Dto\Task\StoreTaskDto;
use App\Services\Dto\Task\UpdateTaskDto;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\DeleteTaskRequest;
use App\Http\Requests\Task\IndexTasksRequest;
use App\Services\Action\Task\DeleteTaskAction;
use App\Services\Action\Task\IndexTaskAction;

class TaskController extends Controller
{
    public function __construct(
        public IndexTaskAction $indexTaskAction,
        public DeleteTaskAction $deleteTaskAction,
        public StoreTaskAction $storeTaskAction,
        public EditTaskAction $editTaskAction,
        public UpdateTaskAction $updateTaskAction
    ) {}

    public function index(IndexTasksRequest $request): View
    {
        $data = $this->indexTaskAction->run($request->getPage(), $request->getAuthor(), $request->getStatus());

        return view(
            'Task/Task',
            array_merge($data, [
                'page'=>$request->getPage(),
                'selectedAuthor' => $request->getAuthor(),
                'selectedStatus' => $request->getStatus()
            ])
        );
    }

    public function delete(DeleteTaskRequest $request): void
    {
        $this->deleteTaskAction->run($request->getId());
    }

    public function create(): View
    {
        return view('Task/Create');
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $dto = StoreTaskDto::fromRequest($request);

        $this->storeTaskAction->run($dto);

        return redirect()->route('tasks_index');
    }

    public function edit(EditTaskRequest $request): View
    {
        $task = $this->editTaskAction->run($request->getTaskId());

        return view('Task/Edit', ['task' => $task]);
    }

    public function update(UpdateTaskRequest $request): RedirectResponse
    {
        $dto = UpdateTaskDto::fromRequest($request);

        $this->updateTaskAction->run($dto);

        return redirect()->route('tasks_index');
    }
}
