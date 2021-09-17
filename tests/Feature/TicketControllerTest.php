<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Lake;
use App\Models\Ticket;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TicketControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_index_with_records(): void
    {
        Ticket::factory(10)->create();

        $response = $this->getJson('/api/ticket');

        $response
            ->assertStatus(200);
    }

    public function test_index_without_records(): void
    {
        $response = $this->getJson('/api/ticket');

        $response
            ->assertStatus(200);
    }

    public function test_store_success(): void
    {
        $carbon = new Carbon();

        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $response = $this->postJson('/api/ticket', [
            "name" => 'Testname',
            "surname" => 'Testsurname',
            "email" => 'email@test.lt',
            "valid_from" => (string)$carbon->now(),
            "valid_to" => (string)$carbon->today()->addDays(3),
            "rods" => rand(1, 10),
            "lakes" => Lake::all()
        ]);

        $response
            ->assertStatus(201);
    }

    public function test_store_with_wrong_valid_from_and_valid_to(): void
    {
        $carbon = new Carbon();

        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $response = $this->postJson('/api/ticket', [
            "name" => 'Testname',
            "surname" => 'Testsurname',
            "email" => 'email@test.lt',
            "valid_from" => (string)$carbon->today()->addDays(3),
            "valid_to" => (string)$carbon->now(),
            "rods" => rand(1, 10),
            "lakes" => Lake::all()
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_store_with_wrong_rods(): void
    {
        $carbon = new Carbon();

        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $response = $this->postJson('/api/ticket', [
            "name" => 'Testname',
            "surname" => 'Testsurname',
            "email" => 'email@test.lt',
            "valid_from" => (string)$carbon->now(),
            "valid_to" => (string)$carbon->today()->addDays(3),
            "rods" => 11,
            "lakes" => Lake::all()
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_show_with_existing_id(): void
    {
        Ticket::factory(1)->create();

        $response = $this->getJson('/api/ticket/1');

        $response
            ->assertStatus(200);
    }

    public function test_show_without_existing_id(): void
    {
        $response = $this->getJson('/api/ticket/1');

        $response
            ->assertStatus(404);
    }

    public function test_delete_success(): void
    {
        Lake::factory(rand(1, 5))->create();
        Ticket::factory(1)->create();

        $response = $this->deleteJson('/api/ticket/1');

        $response
            ->assertStatus(204);
    }

    public function test_delete_without_existing_id(): void
    {
        $response = $this->deleteJson('/api/ticket/1');

        $response
            ->assertStatus(404);
    }

    public function test_generate_serial_number_success(): void
    {

        Lake::factory(rand(1, 5))->create();
        Ticket::factory(2)->create();

        $ticket = new TicketController();
        $serialNumber = $ticket->generateSerialNumber();

        $this->assertEquals(9, strlen((string)$serialNumber));
        $this->assertIsInt($serialNumber);
    }

    public function test_generate_price(): void
    {
        $carbon = new Carbon();

        Lake::factory(rand(1, 5))->create();

        $response = $this->postJson('/api/ticket/price', [
            "lakes" => Lake::all(),
            "valid_from" => (string)$carbon->now(),
            "valid_to" => (string)$carbon->today()->addDays(3),
            "rods" => 5
        ]);

        $response
            ->assertStatus(200);
    }

    public function test_generate_price_with_11_rods(): void
    {
        $carbon = new Carbon();

        Lake::factory(rand(1, 5))->create();

        $response = $this->postJson('/api/ticket/price', [
            "lakes" => Lake::all(),
            "valid_from" => (string)$carbon->now(),
            "valid_to" => (string)$carbon->today()->addDays(3),
            "rods" => 11
        ]);

        $response
            ->assertStatus(422);
    }

    public function test_generate_price_without_lakes(): void
    {
        $carbon = new Carbon();

        $response = $this->postJson('/api/ticket/price', [
            "lakes" => Lake::all(),
            "valid_from" => (string)$carbon->now(),
            "valid_to" => (string)$carbon->today()->addDays(3),
            "rods" => 5
        ]);

        $response
            ->assertStatus(422);
    }
}
