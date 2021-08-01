<?php

namespace App\Mail;

use App\Entities\EmailLog;
use App\Entities\Recipient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var EmailLog
     */
    private $emailLog;
    /**
     * @var Recipient
     */
    private $recipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailLog $emailLog, Recipient $recipient)
    {
        $this->emailLog = $emailLog;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->emailLog->subject)
                    ->view('email.custom')
                    ->with(['html' => str_replace(
                        '{username}',
                        $this->recipient->name,
                        $this->emailLog->emailTemplate->content
                    )]);
    }
}
