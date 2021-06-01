<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    private $threadTitle;
    private $userName;

    /**
     * NewMessage constructor.
     * @param $threadTitle string
     * @param $userName string
     */
    public function __construct($threadTitle, $userName)
    {
        $this->subject('Nowa wiadomość');
        $this->threadTitle = $threadTitle;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-message')->with([
            'threadTitle' => $this->threadTitle,
            'userName' => $this->userName
        ]);
    }
}
