<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegionControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_index_with_records(): int
    {
        Region::factory(10)->create();

        $response = $this->getJson('/api/region');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "regions get successfully"
            ]);
        return 0;
    }

    public function test_index_without_records(): int
    {
        $response = $this->getJson('/api/region');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "no regions"
            ]);
        return 0;
    }

    public function test_show_with_existing_id(): int
    {
        Region::factory(1)->create();

        $response = $this->getJson('/api/region/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "region found successfully"
            ]);
        return 0;
    }

    public function test_show_without_existing_id(): int
    {
        $response = $this->getJson('/api/region/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "region not found"
            ]);
        return 0;
    }
}
