<?php

namespace Tests\Http\Controllers;

use App\Entities\EmailLog;
use App\Entities\EmailTemplate;
use App\Entities\Recipient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailLogsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function add_email_log()
    {
        $existingRecipient = factory(Recipient::class)->create();
        $recipients = factory(Recipient::class, 4)->make();
        $recipients = $recipients->push($existingRecipient);
        $emailLog = factory(EmailLog::class)->make();
        $data = [
            'subject' => $emailLog->subject,
            'email_template_id' => $emailLog->emailTemplate->id,
            'recipients' => $recipients->toArray()
        ];
        $response = $this->post('/email/logs', $data);
        $this->assertEquals(5, collect($response->getOriginalContent()['data']['recipients'])->count());
        $response->assertStatus(200);
    }
}
