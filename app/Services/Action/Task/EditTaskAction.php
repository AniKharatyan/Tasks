<?php

namespace App\Services\Action\Task;

use App\Models\Task;
use App\Repositories\Read\TaskReadRepositoryInterface;

class EditTaskAction
{
    public function __construct(
        public TaskReadRepositoryInterface $taskReadRepository
    ) {}

    public function run(int $id): Task
    {
        try {
            return $this->taskReadRepository->getById($id);
        } catch (\Exception $exception) {
            redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
