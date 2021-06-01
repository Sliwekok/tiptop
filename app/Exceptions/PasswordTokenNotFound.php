<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class PasswordTokenNotFound extends Exception
{
    public function __construct(string $message = "Formularz resetowania hasła jest już nieaktywny. Wyślij formularz przypomnienia hasła ponownie.", int $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
