<?php

namespace App\Exceptions;

use Exception;

class BusinessLogicException extends Exception
{
    const DELETING_ERROR = 600;
    const SAVING_ERROR = 601;
    const UPDATING_ERROR = 602;
}
