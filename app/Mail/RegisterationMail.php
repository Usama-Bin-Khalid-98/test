<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        /*   return $this->view('supervisor.sendmail');*/

        return $this->from('info@nbeac.org.pk','Admin')
            ->subject('Account Registration Request mail')
            ->view('registration.mail.activation_temp')
            ->with('message', 'message here');


    }
}
