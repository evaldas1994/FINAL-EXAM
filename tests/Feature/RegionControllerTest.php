<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Region;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegionControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_index_with_records(): void
    {
        Region::factory(10)->create();

        $response = $this->getJson('/api/region');

        $response
            ->assertStatus(200);
    }

    public function test_index_without_records(): void
    {
        $response = $this->getJson('/api/region');

        $response
            ->assertStatus(200);
    }

    public function test_show_with_existing_id(): void
    {
        Region::factory(1)->create();

        $response = $this->getJson('/api/region/1');

        $response
            ->assertStatus(200);
    }

    public function test_show_without_existing_id(): void
    {
        $response = $this->getJson('/api/region/1');

        $response
            ->assertStatus(404);
    }
}
