<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\Config\NbeacBasicInfo;

class ChangeResgistrationStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
            ->subject('FW: Acknowledgement for Registration Fee')
            ->view('registration.mail.changeRegistrationStatusMail')
            ->with('data', $this->data);
    }
}
