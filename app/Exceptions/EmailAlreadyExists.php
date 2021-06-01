<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class EmailAlreadyExists extends Exception
{
    public function __construct(string $message = "Użytkownik o podanym adresie email istnieje już w bazie danych.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
