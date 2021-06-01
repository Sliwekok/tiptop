<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    private $token;

    /**
     * PasswordReset constructor.
     * @param string $token
     */
    public function __construct($token = '')
    {
        $this->subject('Reset hasła');
        $this->token = $token;
        $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reset-password')->with([
            'token' => $this->token
        ]);
    }
}
