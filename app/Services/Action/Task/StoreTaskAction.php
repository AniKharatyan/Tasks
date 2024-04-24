<?php

namespace App\Services\Action\Task;

use App\Models\Task;
use App\Services\Dto\Task\StoreTaskDto;
use App\Exceptions\SavingErrorException;
use App\Repositories\Write\TaskWriteRepositoryInterface;

class StoreTaskAction
{
    public function __construct(
        public TaskWriteRepositoryInterface $taskWriteRepository
    ) {}

    public function run(StoreTaskDto $dto): void
    {
        $task = Task::staticCreate($dto);

        try {
            $this->taskWriteRepository->save($task);
        } catch (SavingErrorException $exception) {
            redirect()->back()->with('error', $exception->getStatusMessage());
        }
    }
}
