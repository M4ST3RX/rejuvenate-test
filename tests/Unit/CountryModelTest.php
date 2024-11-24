<?php

namespace Tests\Unit;

use App\Models\Country;
use Tests\TestCase;

class CountryModelTest extends TestCase
{
    public function test_it_populates_countries_table(): void
    {
        $countries = Country::get();

        $this->assertCount(4, $countries);
    }
}
