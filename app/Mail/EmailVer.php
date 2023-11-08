<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $token;
    public $type;
    public function __construct($token, $type)
    {
        $this->token = $token;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        if ($this->type == "ver") {
            $sub = 'Email Verifikasi';
        } else {
            $sub = 'Reset Password';
        }
        return new Envelope(
            subject: $sub
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        if ($this->type == "ver") {
            $url = asset('/email-ver/' . $this->token);
        } else {
            $url = asset('/forget-form/' . $this->token);
        }
        return new Content(
            markdown: 'emails.ver',
            with: [
                'url' => $url,
                'type' => $this->type
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
