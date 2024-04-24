<?php

namespace App\Http\Requests\Task;

class UpdateTaskRequest extends AbstractTaskRequest
{
    const TASK_ID = 'task_id';

    public function rules(): array
    {
        $parentRules = parent::rules();

        return array_merge($parentRules, [
            self::TASK_ID => [
                'required',
                'integer'
            ]
        ]);
    }

    public function getTaskId(): int
    {
        return $this->get(self::TASK_ID);
    }
}
