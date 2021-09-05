<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_index_with_records(): int
    {
        User::factory(10)->create();

        $response = $this->getJson('/api/user');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "users get successfully"
            ]);
        return 0;
    }

    public function test_index_without_records(): int
    {
        $response = $this->getJson('/api/user');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "no users"
            ]);
        return 0;
    }

    public function test_show_with_existing_id(): int
    {
        User::factory(1)->create();

        $response = $this->getJson('/api/user/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "user found successfully"
            ]);
        return 0;
    }

    public function test_show_without_existing_id(): int
    {
        $response = $this->getJson('/api/user/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "user not found"
            ]);
        return 0;
    }

    public function test_update_with_existing_id(): int
    {
        User::factory(1)->create();

        $response = $this->patchJson('/api/user/1', [
            "name" => "njonas",
            "surname" => "njonaitis",
            "password" => "n00555",
            "password_confirmation" => "n00555",
            "email" => "nmjonas.jonaitis@gmail22.com"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "user updated successfully",
                "data" => [
                    "name" => "njonas",
                    "surname" => "njonaitis",
                    "email" => "nmjonas.jonaitis@gmail22.com"
                ]
            ]);
        return 0;
    }

    public function test_update_without_existing_id(): int
    {
        $response = $this->patchJson('/api/user/1', [
            "name" => "njonas",
            "surname" => "njonaitis",
            "password" => "n00555",
            "password_confirmation" => "n00555",
            "email" => "nmjonas.jonaitis@gmail22.com"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "user not found"
            ]);
        return 0;
    }

    public function test_delete_with_existing_id(): int
    {
        User::factory(1)->create();

        $response = $this->deleteJson('/api/user/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "user deleted successfully"
            ]);
        return 0;
    }

    public function test_delete_without_existing_id(): int
    {
        $response = $this->deleteJson('/api/user/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => false,
                "message" => "user not found"
            ]);
        return 0;
    }
}
