<?php

namespace App\Services\Action\Task;

use App\Exceptions\DeletingErrorException;
use App\Repositories\Write\TaskWriteRepositoryInterface;

class DeleteTaskAction
{
    public function __construct(
        public TaskWriteRepositoryInterface $taskWriteRepository
    ) {}

    public function run(int $id): void
    {
        try {
            $this->taskWriteRepository->deleteById($id);
        } catch (DeletingErrorException $exception) {
            redirect()->back()->with('error', $exception->getStatusMessage());
        }
    }
}
