<?php

namespace App\Repositories\Read;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskReadRepositoryInterface
{
    public function index(int $page = null, string $author = null, string $status = null): LengthAwarePaginator;
    public function allTasks(): Collection;
    public function getById(int $id): Task;
}
