<?php

namespace App\Services\Dto\Task;

use App\Http\Requests\Task\UpdateTaskRequest;

class UpdateTaskDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $author,
        public string $status
    ) {}

    public static function fromRequest(UpdateTaskRequest $request): UpdateTaskDto
    {
        return new self(
            id: $request->getTaskId(),
            name: $request->getName(),
            author: $request->getAuthor(),
            status: $request->getStatus()
        );
    }
}
