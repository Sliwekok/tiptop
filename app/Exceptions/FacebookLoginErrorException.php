<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class FacebookLoginErrorException extends Exception
{
    public function __construct(string $message = "Wystąpił błąd podczas pobierania informacji z Facebook. Spróbuj ponownie za kilka chwil.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
