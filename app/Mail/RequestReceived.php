<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestReceived extends Mailable
{
    use Queueable, SerializesModels;



    public $user;
    public $slide;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $slide)
    {
        $this->user = $user;
        $this->slide = $slide;
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Request Received',
        );
    }


    // public function build()
    // {
    //     return $this->markdown('emails.request-received')
    //                 ->subject('Your request has been received');
    // }

    public function content()
    {
        return new Content(
            markdown: 'emails.request-received',
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
