<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTemplatesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function add_email_template()
    {
        $this->withoutExceptionHandling();
        $data = [
            'content' => '<h1>Dear {username}</h1>'
        ];
        $response = $this->post('/email/templates', $data);
        $this->assertDatabaseHas('email_templates', $data);
        $response->assertStatus(200);
    }
}
