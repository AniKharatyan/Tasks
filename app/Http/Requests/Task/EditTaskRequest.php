<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class EditTaskRequest extends FormRequest
{
    const TASK_ID = 'task_id';

    public function rules(): array
    {
        return [
            self::TASK_ID => [
                'required',
                'integer'
            ],
        ];
    }

    public function getTaskId(): int
    {
        return $this->get(self::TASK_ID);
    }
}
