<?php

namespace App\Repositories\Read;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskReadRepository implements TaskReadRepositoryInterface
{
    private function query(): Builder
    {
        return Task::query();
    }

    public function index(int $page = null, string $author = null, string $status = null): LengthAwarePaginator
    {
        return $this->query()
            ->when($author, function (Builder $query) use ($author) {
                $query->whereRaw('author COLLATE utf8mb4_bin LIKE ?', ['%' . $author . '%']);
            })
            ->when($status, function (Builder $query) use ($status) {
                $query->whereRaw('status COLLATE utf8mb4_bin LIKE ?', ['%' . $status . '%']);
            })
            ->paginate(5, ['*'], 'page');
    }


    public function allTasks(): Collection
    {
        return $this->query()->get();
    }

    public function getById(int $id): Task
    {
        return $this->query()->findOrFail($id);
    }
}
