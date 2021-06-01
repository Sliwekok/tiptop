<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AnimalNotFound extends Exception
{
    public function __construct(string $message = "Nie można wyświetlić ogłoszenia ponieważ nie istnieje lub zostało usunięte.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
