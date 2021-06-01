<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class WrongFacebookRegisterData extends Exception
{
    public function __construct(string $message = "Wystąpił błąd w zgodności danych, proszę spróbować ponownie.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
