<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupportReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $reason;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $reason, $message)
    {
        $this->name = $name;
        $this->reason = $reason;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(

            subject: 'Invitory Support Receipt Mail',  

        );

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(

            markdown: 'mail.support-receipt',

            with: [

                'name' => $this->name,
                'reason' => $this->reason,
                'message' => $this->message
       
            ],

        );
        
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
