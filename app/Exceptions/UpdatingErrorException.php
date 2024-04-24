<?php

namespace App\Exceptions;

use Exception;

class UpdatingErrorException extends Exception
{
    public function getStatus(): int
    {
        return BusinessLogicException::UPDATING_ERROR;
    }

    public function getStatusMessage(): string
    {
        return 'Ошибка при редактировании!';
    }
}
