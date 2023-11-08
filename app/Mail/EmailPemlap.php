<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailPemlap extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $webUrl;
    public $emailAcc;
    public $passAcc;
    public function __construct($url, $email, $password)
    {
        $this->webUrl = $url;
        $this->emailAcc = $email;
        $this->passAcc = $password;
    }
    // public function build()
    // {
    //     return $this->subject('Pembuatan Akun MBKM')
    //         ->view('emails.pemlap')
    //         ->with(['websiteUrl' => $this->webUrl]); // Pass the website URL to the view
    // }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Email Pemlap',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.pemlap',
            with: [
                'url' => $this->webUrl,
                'email' => $this->emailAcc,
                'pass' => $this->passAcc,
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
