<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AccessDenied extends Exception
{
    public function __construct(string $message = "Nie masz dostępu do żądanych zasobów.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
