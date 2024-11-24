<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Country;
use Illuminate\Console\Command;

class ImportClientsToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import clients from json into database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $clients = json_decode(file_get_contents(storage_path() . "/app/private/clients.json"));

        foreach($clients as $client) {
            $Country = Country::where("name", $client->country)->first();

            if(!$Country) {
                $this->warn("{$client->first_name} {$client->last_name} is from {$client->country} which does not exist in database.");
                continue;
            }

            $Client = Client::updateOrCreate([
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'email' => $client->email
            ], [
                'country_id' => $Country->id,
                'active' => $client->active
            ]);

            $Client->save();

            $this->info("{$client->first_name} {$client->last_name} added to database.");
        }
    }
}
