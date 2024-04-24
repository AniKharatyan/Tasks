<?php

namespace App\Services\Action\Task;

use App\Exceptions\UpdatingErrorException;
use App\Repositories\Write\TaskWriteRepositoryInterface;
use App\Services\Dto\Task\UpdateTaskDto;

class UpdateTaskAction
{
    public function __construct(
        public TaskWriteRepositoryInterface $taskWriteRepository
    ) {}

    public function run(UpdateTaskDto $dto): void
    {
        $data = $this->taskToUpdate($dto);

        try {
            $this->taskWriteRepository->update($dto->id, $data);
        } catch (UpdatingErrorException $exception) {
            redirect()->back()->with('error', $exception->getStatusMessage());
        }
    }

    public function taskToUpdate(UpdateTaskDto $dto): array
    {
        return [
            'name' => $dto->name,
            'author' => $dto->author,
            'status' => $dto->status,
        ];
    }
}
