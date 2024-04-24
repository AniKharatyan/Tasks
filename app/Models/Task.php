<?php

namespace App\Models;

use App\Services\Dto\Task\StoreTaskDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $name
 * @property string $author
 * @property string $status
 */

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'status'
    ];

    protected $table = 'tasks';

    public static function staticCreate(StoreTaskDto $dto): Task
    {
        $task = new static();

        $task->setName($dto->name);
        $task->setAuthor($dto->author);
        $task->setStatus($dto->status);

        return $task;
    }

    public function setName(string $name): void
    {
        $this->name= $name;
    }

    public function setAuthor(string $author): void
    {
        $this->author= $author;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
