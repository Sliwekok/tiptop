<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CantMessageYourself extends Exception
{
    public function __construct(string $message = "Nie można wysłać wiadomości do siebie.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
