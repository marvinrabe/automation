<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    public function testRedirectsToAutomations()
    {
        $response = $this->get('/');

        $response->assertRedirect('/automations');
    }
}
