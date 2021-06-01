<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $userName;

    /**
     * AccountCreated constructor.
     * @param string $userName
     */
    public function __construct($userName = '')
    {
        $this->subject('Konto utworzone');
        $this->userName = $userName;
        $this->attach(resource_path('/docs/terms/regulamin.pdf'));
        $this->attach(resource_path('/docs/policy-privacy/polityka-prywatnosci.pdf'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.account-created')->with([
            'userName' => $this->userName
        ]);
    }
}
