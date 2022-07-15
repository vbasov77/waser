<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBookingAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;

    public $send_mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $send_mail)
    {
        $this->subject = $subject;
        $this->send_mail  = $send_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('mail.send_book_admin', [
                'data' => $this -> send_mail
            ]);
    }
}
