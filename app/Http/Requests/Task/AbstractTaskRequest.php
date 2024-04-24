<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class AbstractTaskRequest extends FormRequest
{
    const NAME = 'name';
    const AUTHOR = 'author';
    const STATUS = 'status';

    public function rules(): array
    {
        return [
            self::NAME => [
                'required',
                'string'
            ],

            self::AUTHOR => [
                'required',
                'string'
            ],

            self::STATUS => [
                'required',
                'string'
            ],
        ];
    }

    public function getName(): string
    {
        return $this->get(self::NAME);
    }

    public function getAuthor(): string
    {
        return $this->get(self::AUTHOR);
    }

    public function getStatus(): string
    {
        return $this->get(self::STATUS);
    }
}
