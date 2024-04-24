<?php

namespace App\Services\Dto\Task;

use App\Http\Requests\Task\StoreTaskRequest;

class StoreTaskDto
{
    public function __construct(
        public string $name,
        public string $author,
        public string $status
    ) {}

    public static function fromRequest(StoreTaskRequest $request): StoreTaskDto
    {
        return new self(
            name: $request->getName(),
            author: $request->getAuthor(),
            status: $request->getStatus()
        );
    }
}
