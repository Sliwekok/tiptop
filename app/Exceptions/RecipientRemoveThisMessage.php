<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class RecipientRemoveThisMessage extends Exception
{
    public function __construct(string $message = "Nie można wysłać wiadomości ponieważ odbiorca usunął ten wątek.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
