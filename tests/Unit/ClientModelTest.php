<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Country;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ClientModelTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_clients_table_exists(): void
    {
        $this->AssertTrue(Schema::hasTable("clients"));
    }

    public function test_clients_table_populated(): void
    {
        $this->artisan("import:clients");
        $clients = Client::get();

        $this->assertCount(50, $clients);
    }

    public function test_country_column_relation(): void
    {
        $this->artisan("import:clients");
        $client = Client::find(1);

        $this->assertIsObject($client->country);
        $this->assertTrue($client->country instanceof Country);
    }
}
