<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CantMessageInThread extends Exception
{
    public function __construct(string $message = "Nie możesz pisać w tej konwersacji ponieważ do niej nie należysz.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
