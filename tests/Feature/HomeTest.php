<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Client list');
    }

    public function test_clients_are_displayed_in_table(): void
    {
        $this->artisan("import:clients");
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<table', false);
        $response->assertSee('<tbody', false);
        $response->assertSee('</tr>', false);
    }

    public function test_search_returns_with_correct_data(): void
    {
        $this->artisan("import:clients");

        $response = $this->postJson('/search', [
            'search' => 'Lenora',
            'countries' => [],
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'first_name' => 'Lenora',
            'last_name' => 'Ferry',
            'email' => 'dereck.homenick@example.org',
        ]);
    }

    public function test_filter_by_country(): void
    {
        $this->artisan("import:clients");

        $response = $this->postJson('/search', [
            'search' => '',
            'countries' => ['GB'],
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'first_name' => 'Lenora',
            'last_name' => 'Ferry',
            'email' => 'dereck.homenick@example.org',
        ]);
        $response->assertJsonMissing([
            'first_name' => 'Maryse',
            'last_name' => 'Purdy',
            'email' => 'cathryn21@example.org',
        ]);
    }
}
