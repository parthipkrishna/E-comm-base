<?php

namespace App\Mail;


use Illuminate\Mail\Mailable;


class ContactMail extends Mailable
{
    public $formData;

    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission')
                    ->view('emails.contact');
    }

}