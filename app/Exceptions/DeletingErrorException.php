<?php

namespace App\Exceptions;

use Exception;

class DeletingErrorException extends Exception
{
    public function getStatus(): int
    {
        return BusinessLogicException::DELETING_ERROR;
    }

    public function getStatusMessage(): string
    {
        return 'Ошибка при удалиении!';
    }
}
