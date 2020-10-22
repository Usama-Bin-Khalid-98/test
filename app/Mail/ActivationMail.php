<?php

namespace App\Mail;

use App\Models\Config\NbeacBasicInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        //
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $getInfo = NbeacBasicInfo::all()->first();
        return $this->from($getInfo->email,'NBEAC Admin')
            ->subject('Account Registration Request mail')
            ->view('registration.mail.activation_temp')
            ->with('message', 'message here');

    }
}
