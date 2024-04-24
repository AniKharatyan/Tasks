<?php

namespace App\Repositories\Write;

use App\Exceptions\DeletingErrorException;
use App\Exceptions\SavingErrorException;
use App\Exceptions\UpdatingErrorException;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;

class TaskWriteRepository implements TaskWriteRepositoryInterface
{
    private function query(): Builder
    {
        return Task::query();
    }

    /**
     * @throws DeletingErrorException
     */
    public function deleteById(int $id): bool
    {
        $response = $this->query()->find($id)->delete();

        if(!$response) {
            throw new DeletingErrorException();
        }

        return true;
    }

    /**
     * @throws SavingErrorException
     */
    public function save(Task $task): bool
    {
        if(!$task->save()) {
            throw new SavingErrorException();
        }

        return true;
    }

    /**
     * @throws UpdatingErrorException
     */
    public function update(int $id, array $data): bool
    {
        $response = $this->query()->find($id)->update($data);

        if(!$response) {
            throw new UpdatingErrorException();
        }

        return true;
    }
}
