<?php

namespace App\Mail;

use App\ATG;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ATG $atg)
    {
        $this->atg = $atg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'shafique.md18@gmail.com';
        $subject = 'Information submitted successfully!';
        $name = 'Shafique Mohammad';

        return $this->markdown('emails.welcome')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'data' => $this->atg ]);;
    }
}
