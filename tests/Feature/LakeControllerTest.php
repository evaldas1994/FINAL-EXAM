<?php

namespace Tests\Feature;

use App\Models\Lake;
use App\Models\Region;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LakeControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_index_with_records(): int
    {
        Lake::factory(10)->create();

        $response = $this->getJson('/api/lake');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "lakes get successfully"
            ]);
        return 0;
    }

    public function test_index_without_records(): int
    {
        $response = $this->getJson('/api/lake');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "no lakes"
            ]);
        return 0;
    }

    public function test_store_success(): int
    {
        Region::factory(1)->create();

        $response = $this->postJson('/api/lake', [
            "name" => "lake1",
            "region_id" => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "lake created successfully"
            ]);
        return 0;
    }

    public function test_store_without_existing_region(): int
    {
        $response = $this->postJson('/api/lake', [
            "name" => "lake1",
            "region_id" => 1
        ]);

        $response
            ->assertStatus(422);
        return 0;
    }

    public function test_store_with_occupied_name(): int
    {
        Region::factory(1)->create([]);
        Lake::factory(1)->create([
            'name' => "lake1"
        ]);

        $response = $this->postJson('/api/lake', [
            "name" => "lake1",
            "region_id" => 1
        ]);

        $response
            ->assertStatus(422);
        return 0;
    }

    public function test_store_without_name(): int
    {
        Region::factory(1)->create();

        $response = $this->postJson('/api/lake', [
            "region_id" => 2
        ]);

        $response
            ->assertStatus(422);
        return 0;
    }

    public function test_show_with_existing_id(): int
    {
        Lake::factory(1)->create();

        $response = $this->getJson('/api/lake/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "lake found successfully"
            ]);
        return 0;
    }

    public function test_show_without_existing_id(): int
    {
        $response = $this->getJson('/api/lake/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "lake not found"
            ]);
        return 0;
    }

    public function test_update_success(): int
    {
        Region::factory(10)->create();
        Lake::factory(1)->create();

        $response = $this->patchJson('/api/lake/1', [
            "name" => "lake1",
            "region_id" => 3
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "lake updated successfully"
            ]);
        return 0;
    }

    public function test_update_without_existing_id(): int
    {
        Region::factory(10)->create();

        $response = $this->patchJson('/api/lake/1', [
            "name" => "lake1",
            "region_id" => 3
        ]);

        $response
            ->assertStatus(422);
        return 0;
    }

    public function test_update_without_existing_region(): int
    {
        Region::factory(10)->create();
        Lake::factory(1)->create();

        $response = $this->patchJson('/api/lake/1', [
            "name" => "lake1",
            "region_id" => 30
        ]);

        $response
            ->assertStatus(422);
        return 0;
    }

    public function test_update_with_occupied_name(): int
    {
        Region::factory(10)->create();
        Lake::factory(1)->create();
        Lake::factory(1)->create([
            "name" => "lake1"
        ]);

        $response = $this->patchJson('/api/lake/1', [
            "name" => "lake1",
            "region_id" => 1
        ]);

        $response
            ->assertStatus(422);
        return 0;
    }

    public function test_delete_success(): int
    {
        Region::factory(10)->create();
        Lake::factory(1)->create();

        $response = $this->deleteJson('/api/lake/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "lake deleted successfully"
            ]);
        return 0;
    }

    public function test_delete_without_existing_id(): int
    {
        $response = $this->deleteJson('/api/lake/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "lake not found"
            ]);
        return 0;
    }
}
