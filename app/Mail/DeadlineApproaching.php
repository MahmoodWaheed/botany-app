<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DeadlineApproaching extends Mailable
{
    use Queueable, SerializesModels;


    public $slide;
    public $user;
    public $Deadline;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id, $slide_id,$end_date)
    {
        $this->user = DB::table('users')->find($user_id);
        $this->slide = DB::table('slides')->find($slide_id);
        $this->Deadline = $end_date->toFormattedDateString();
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Deadline Approaching',
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
            markdown: 'request-Deadline-Approaching',
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
//php artisan make:mail DeadlineApproaching --markdown=request-Deadline-Approaching
