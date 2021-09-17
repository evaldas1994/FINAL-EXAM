<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Lake;
use App\Models\Region;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LakeControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_index_with_records(): void
    {
        Lake::factory(10)->create();

        $response = $this->getJson('/api/lake');

        $response
            ->assertStatus(200);
    }

    public function test_index_without_records(): void
    {
        $response = $this->getJson('/api/lake');

        $response
            ->assertStatus(200);
    }

    public function test_store_success(): void
    {
        Region::factory(1)->create();

        $response = $this->postJson('/api/lake', [
            'name' => 'lake1',
            'region_id' => 1
        ]);

        $response
            ->assertStatus(201);
    }

    public function test_store_without_existing_region(): void
    {
        $response = $this->postJson('/api/lake', [
            'name' => 'lake1',
            'region_id' => 1
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_store_with_occupied_name(): void
    {
        Region::factory(1)->create([]);
        Lake::factory(1)->create([
            'name' => 'lake1'
        ]);

        $response = $this->postJson('/api/lake', [
            'name' => 'lake1',
            'region_id' => 1
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_store_without_name(): void
    {
        Region::factory(1)->create();

        $response = $this->postJson('/api/lake', [
            'region_id' => 2
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_show_with_existing_id(): void
    {
        Lake::factory(1)->create();

        $response = $this->getJson('/api/lake/1');

        $response
            ->assertStatus(200);
    }

    public function test_show_without_existing_id(): void
    {
        $response = $this->getJson('/api/lake/1');

        $response
            ->assertStatus(404);
    }

    public function test_update_success(): void
    {
        Region::factory(10)->create();
        Lake::factory(1)->create();

        $response = $this->patchJson('/api/lake/1', [
            'name' => 'lake1',
            'region_id' => 3
        ]);

        $response
            ->assertStatus(200);
    }

    public function test_update_without_existing_id(): void
    {
        $response = $this->patchJson('/api/lake/1', [
            'name' => 'lake1',
            'region_id' => 3
        ]);

        $response
            ->assertStatus(404);
    }

    public function test_update_without_existing_region(): void
    {
        Region::factory(10)->create();
        Lake::factory(1)->create();

        $response = $this->patchJson('/api/lake/1', [
            'name' => 'lake1',
            'region_id' => 30
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_update_with_occupied_name(): void
    {
        Region::factory(10)->create();
        Lake::factory(1)->create();
        Lake::factory(1)->create([
            'name' => 'lake1'
        ]);

        $response = $this->patchJson('/api/lake/1', [
            'name' => 'lake1',
            'region_id' => 1
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_delete_success(): void
    {
        Lake::factory(1)->create();

        $response = $this->deleteJson('/api/lake/1');

        $response
            ->assertStatus(204);
    }

    public function test_delete_without_existing_id(): void
    {
        $response = $this->deleteJson('/api/lake/1');

        $response
            ->assertStatus(404);
    }
}
