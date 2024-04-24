<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class IndexTasksRequest extends FormRequest
{
    const AUTHOR = 'author';
    const STATUS = 'status';
    public const PAGE = 'page';

    public function rules(): array
    {
        return [
            self::AUTHOR => [
                'nullable',
                'string'
            ],

            self::STATUS => [
                'nullable',
                'string'
            ],

            self::PAGE => [
                'nullable',
                'string'
            ]
        ];
    }

    public function getAuthor(): ?string
    {
        return $this->get(self::AUTHOR);
    }

    public function getStatus(): ?string
    {
        return $this->get(self::STATUS);
    }

    public function getPage(): string
    {
        $page = $this->get(self::PAGE);
        return $page <= 0 ? 1 : $page;
    }
}
