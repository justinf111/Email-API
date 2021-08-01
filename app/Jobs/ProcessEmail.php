<?php

namespace App\Jobs;

use App\Actions\SwapEmailService;
use App\Entities\EmailLog;
use App\Entities\Recipient;
use App\Mail\CustomEmail;
use App\Repositories\EmailLogRepository;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var EmailLog
     */
    private $emailLog;
    /**
     * @var Recipient
     */
    private $recipient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EmailLog $emailLog, Recipient $recipient)
    {

        $this->emailLog = $emailLog;
        $this->recipient = $recipient;
    }

    /**
     * Send off email and swap to backup email service provider if the initial one fails. It will fail once both primary and backup email providers have been attempted 3 times each
     *
     * @return void
     */
    public function handle(EmailLogRepository $emailLogRepository, SwapEmailService $swapEmailService)
    {
        $count = 0;
        $maxTries = 3;
        $emailServiceSwapped = false;
        while(true) {
            try {
                \Mail::to($this->recipient->email)->send(new CustomEmail($this->emailLog, $this->recipient));
                //Ideally would be set to pending and then have a callback from the email provider to indicate that it has been delivered
                $this->emailLog->recipients()->updateExistingPivot($this->recipient->id, [
                    'status' => 'Delivered'
                ]);
            } catch (\Swift_TransportException $exception) {
                if($emailServiceSwapped && ++$count == $maxTries) {
                    $this->fail();
                }
                elseif (++$count == $maxTries) {
                    $count = 0;
                    $swapEmailService->execute('backup');
                    $emailServiceSwapped = true;
                }
            }
        }
    }
}
