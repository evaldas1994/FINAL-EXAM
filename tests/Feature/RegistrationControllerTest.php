<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

/**
 * @method seeInDatabase(string $string, string[] $array)
 * @method assertStatus(int $int)
 * @method be($user)
 */
class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_user(): int
    {
        $request = new Request([
            "name" => "name",
            "surname" => "surname",
            "password" => "00555",
            "password_confirmation" => "00555",
            "email" => "test.testing@test.com"
        ]);

        $userService = new UserService();

        $result = $userService->create_validation($request);

        $this->assertDatabaseHas('users', [
            "id" => $result['data']->id,
            "name" => $result['data']->name,
            "surname" => $result['data']->surname,
            "password" => $result['data']->password,
            "email" => $result['data']->email,
            "created_at" => $result['data']->created_at,
            "updated_at" => $result['data']->updated_at,
            "is_admin" => false,
            "remember_token" => null,
            "email_verified_at" => null
        ]);

        return 0;
    }
}
