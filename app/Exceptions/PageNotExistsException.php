<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class PageNotExistsException extends Exception
{
    public function __construct(string $message = "Żądana strona nie może zostać wyświetlona ponieważ nie istnieje.", int $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
