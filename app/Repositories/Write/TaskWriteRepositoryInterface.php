<?php

namespace App\Repositories\Write;

use App\Models\Task;

interface TaskWriteRepositoryInterface
{
    public function deleteById(int $id): bool;
    public function save(Task $task): bool;
    public function update(int $id, array $data): bool;
}
