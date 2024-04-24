<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTaskRequest extends FormRequest
{
    public function getId(): int
    {
        return $this->route('id');
    }
}
