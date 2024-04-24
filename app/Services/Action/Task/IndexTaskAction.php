<?php

namespace App\Services\Action\Task;

use App\Repositories\Read\TaskReadRepositoryInterface;

class IndexTaskAction
{
    public function __construct(
        public TaskReadRepositoryInterface $taskReadRepository
    ) {}

    public function run(?int $page, ?string $author, ?string $status): array
    {
        $tasks = $this->taskReadRepository->index($page, $author, $status);

        $allTasks = $this->taskReadRepository->allTasks();

        $authors = $allTasks->pluck('author')->unique()->toArray();

        $statuses = $allTasks->pluck('status')->unique()->toArray();

        return compact('tasks','authors', 'statuses');
    }
}
