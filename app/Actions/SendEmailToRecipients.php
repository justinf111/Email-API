<?php


namespace App\Actions;


use App\Entities\EmailLog;
use App\Mail\CustomEmail;
use Mail;
use Swift_TransportException;

class SendEmailToRecipients
{
    public function __construct() {
    }

    public function execute(EmailLog $emailLog) {
        foreach($emailLog->recipients as $recipient) {
            try {
                Mail::to($recipient->email)->send(new CustomEmail($emailLog, $recipient));
            } catch(Swift_TransportException $e) {
                dd($e);
            }
        }
        return $emailLog;
    }
}