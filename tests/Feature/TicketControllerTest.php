<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Lake;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_index_with_records(): int
    {
        Ticket::factory(10)->create();

        $response = $this->getJson('/api/ticket');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'tickets get successfully'
            ]);
        return 0;
    }

    public function test_index_without_records(): int
    {
        $response = $this->getJson('/api/ticket');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
                'message' => 'no tickets'
            ]);
        return 0;
    }

    public function test_store_success(): int
    {
        $carbon = new Carbon();
        User::factory(1)->create();
        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $request = new Request([
            "user_id" => 1,
            "name" => 'Test',
            "surname" => 'Tester',
            "email" => 'email.test@email.lt',
            "valid_from" => (string)$carbon->now(),
            "valid_to" => (string)$carbon->today()->addDays(3),
            "rods" => rand(1, 10),
            "lakes" => Lake::all()
        ]);

        $response = $this->postJson('/api/ticket', [
            "user_id" => 1,
            "name" => $request['name'],
            "surname" => $request['surname'],
            "email" => $request['email'],
            "valid_from" => $request['valid_from'],
            "valid_to" => $request['valid_to'],
            "rods" => $request['rods'],
            "lakes" => $request['lakes']
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'ticket created successfully'
            ]);
        return 0;
    }

    public function test_store_with_wrong_valid_from_and_valid_to(): int
    {
        $carbon = new Carbon();
        User::factory(1)->create();
        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $request = new Request([
            "user_id" => 1,
            "name" => 'Test',
            "surname" => 'Tester',
            "email" => 'email.test@email.lt',
            "valid_from" => (string)$carbon->today()->addDays(3),
            "valid_to" => (string)$carbon->now(),
            "rods" => rand(1, 10),
            "lakes" => Lake::all()
        ]);

        $response = $this->postJson('/api/ticket', [
            "user_id" => 1,
            "name" => $request['name'],
            "surname" => $request['surname'],
            "email" => $request['email'],
            "valid_from" => $request['valid_from'],
            "valid_to" => $request['valid_to'],
            "rods" => $request['rods'],
            "lakes" => $request['lakes']
        ]);

        $response
            ->assertStatus(422);
        return 0;
    }

    public function test_store_without_price(): int
    {
        $carbon = new Carbon();
        User::factory(1)->create();
        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $request = new Request([
            "user_id" => 1,
            "name" => 'Test',
            "surname" => 'Tester',
            "email" => 'email.test@email.lt',
            "valid_from" => (string)$carbon->today()->addDays(3),
            "valid_to" => (string)$carbon->now(),
            "rods" => rand(1, 10),
            "lakes" => Lake::all()
        ]);

        $response = $this->postJson('/api/ticket', [
            "user_id" => 1,
            "name" => $request['name'],
            "surname" => $request['surname'],
            "email" => $request['email'],
            "valid_from" => $request['valid_from'],
            "valid_to" => $request['valid_to'],
            "rods" => $request['rods'],
            "lakes" => $request['lakes']
        ]);

        $response
            ->assertStatus(422);
        return 0;
    }

    public function test_show_with_existing_id(): int
    {
        Ticket::factory(1)->create();

        $response = $this->getJson('/api/ticket/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'ticket found successfully'
            ]);
        return 0;
    }

    public function test_show_without_existing_id(): int
    {
        $response = $this->getJson('/api/ticket/1');

        $response
            ->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'ticket not found'
            ]);
        return 0;
    }

    public function test_update_success(): int
    {
        $carbon = new Carbon();
        User::factory(1)->create();
        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $response = $this->patchJson('/api/ticket/1', [
            "user_id" => 1,
            "name" => 'Test',
            "surname" => 'Tester',
            "email" => 'email.test@email.lt',
            "valid_from" => (string)$carbon->now(),
            "valid_to" => (string)$carbon->today()->addDays(3),
            "rods" => rand(1, 10),
            "lakes" => Lake::all()
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'ticket updated successfully'
            ]);
        return 0;
    }

    public function test_update_without_existing_id(): int
    {
        $carbon = new Carbon();
        User::factory(1)->create();
        Lake::factory(rand(1, 5))->create();

        $response = $this->patchJson('/api/ticket/1', [
            "user_id" => 1,
            "name" => 'Test',
            "surname" => 'Tester',
            "email" => 'email.test@email.lt',
            "valid_from" => (string)$carbon->now(),
            "valid_to" => (string)$carbon->today()->addDays(3),
            "rods" => rand(1, 10),
            "lakes" => Lake::all()
        ]);

        $response
            ->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'ticket not found'
            ]);
        return 0;
    }

    public function test_delete_success(): int
    {
        User::factory(1)->create();
        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $response = $this->deleteJson('/api/ticket/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'ticket deleted successfully'
            ]);
        return 0;
    }

    public function test_delete_without_existing_id(): int
    {
        $response = $this->deleteJson('/api/ticket/1');

        $response
            ->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'ticket not found'
            ]);
        return 0;
    }

    public function test_generate_serial_number_success(): int
    {
        User::factory(1)->create();
        Lake::factory(rand(1, 5))->create();
        Ticket::factory(2)->create();

        $ticket = new TicketController();
        $serialNumber = $ticket->generateSerialNumber();

        $this->assertEquals (9, strlen((string)$serialNumber));
        $this->assertIsInt($serialNumber);

        return 0;
    }
}
