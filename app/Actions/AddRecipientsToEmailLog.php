<?php
namespace App\Actions;

use App\Entities\EmailLog;
use App\Repositories\EmailLogRepository;
use App\Repositories\RecipientRepository;
use Illuminate\Support\Collection;

class AddRecipientsToEmailLog {
    /**
     * @var RecipientRepository
     */
    private $recipientRepository;
    /**
     * @var EmailLogRepository
     */
    private $emailLogRepository;

    public function __construct(EmailLogRepository $emailLogRepository, RecipientRepository $recipientRepository) {

        $this->recipientRepository = $recipientRepository;
        $this->emailLogRepository = $emailLogRepository;
    }

    public function execute(EmailLog $emailLog, Collection $recipients) {
        $existingRecipients = $this->recipientRepository->findWhereIn('email', $recipients->pluck('email')->toArray());
        foreach($recipients->unique() as $recipient) {
            if(!$existingRecipients->contains('email', $recipient['email'])) {
                $this->emailLogRepository->syncWithoutDetaching(
                    $emailLog->id,
                    'recipients',
                    $this->recipientRepository->create([
                        'name' => $recipient['name'],
                        'email' => $recipient['email']
                    ])->id
                );
            }
        }
        $this->emailLogRepository->syncWithoutDetaching($emailLog->id, 'recipients', $existingRecipients->pluck('id')->toArray());
        return $emailLog->load('recipients');
    }
}