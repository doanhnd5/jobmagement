<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailApplySuccess extends Mailable
{
    use Queueable, SerializesModels;

    const MAIL_SUBJECT    = "Ứng tuyển công việc ";
    const SUCCESS_MESSAGE = " thành công!";

    public $mailData;
    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = self::MAIL_SUBJECT . $this->mailData['job_name'] . self::SUCCESS_MESSAGE;
        return new Envelope(
            subject: $subject ,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.index',
            with: [
                'genderContext'  => ' ' . $this->mailData['gender'],
                'jobName'        => $this->mailData['job_name'],
                'candidatesName' => $this->mailData['candidates_name'],
                'senderName'     => $this->mailData['sender_name'],
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
