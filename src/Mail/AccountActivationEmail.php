<?php

namespace Devmi\Laraconfirm\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivationEmail extends Mailable
{

    use SerializesModels;

    public $token;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email , $token)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Laraconfirm::emails.confirmation');
    }
}
