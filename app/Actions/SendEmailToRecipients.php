<?php


namespace App\Actions;


use App\Entities\EmailLog;
use App\Jobs\ProcessEmail;
use App\Mail\CustomEmail;
use Mail;
use Swift_TransportException;

class SendEmailToRecipients
{
    public function __construct() {
    }

    public function execute(EmailLog $emailLog) {
        foreach($emailLog->recipients as $recipient) {
            ProcessEmail::dispatch($emailLog, $recipient);
        }
    }
}