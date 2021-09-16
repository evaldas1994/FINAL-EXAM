<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ticket\TicketPriceRequest;
use App\Http\Requests\Api\Ticket\TicketCreateRequest;

class TicketController extends Controller
{
    public function index(): JsonResponse
    {
        $tickets = Ticket::all();

        $ticketService = new TicketService();

        return response()
            ->json(['data' => $tickets]);
    }

    public function store(TicketCreateRequest $request): JsonResponse
    {
        $ticket = Ticket::create([
            "name" => TicketService::wordsToFirstLetterUpper($request->input('name')),
            "surname" =>  TicketService::wordsToFirstLetterUpper($request->input('surname')),
            "email" => TicketService::wordsToFirstLetterUpper($request->input('email')),
            "serial_number" => $this->generateSerialNumber(),
            "valid_from" => $request->input('valid_from'),
            "valid_to" => $request->input('valid_to'),
            "price" => $this->generatePrice($request)['price'],
            "rods" => $request->input('rods')
        ]);

        for ($i = 0; $i < count($request->input('lakes')); $i++) {
            $ticket->lakes()->attach($request->input('lakes')[$i]['id']);
        }

        return response()
            ->json(['data' => $ticket], 201);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        return response()
            ->json(['data' => $ticket], 200);
    }

    public function destroy(Ticket $ticket): Response
    {
        $ticket->delete();

        return response(null, 204);
    }

    public function price(TicketPriceRequest $request): JsonResponse
    {
        return response()
            ->json(['data' => $this->generatePrice($request)], 200);
    }

    public function generateSerialNumber(): int
    {
        $carbon = new Carbon();
        $date = $carbon->now();

        $tickets = Ticket::select('serial_number')
            ->whereDate('created_at', '=', $date->startOfDay())
            ->get();

        $part1 = $this->getPart1($date);
        $part2 = $this->getPart2($date);
        $part3 = $this->getPart3($date);
        $part4 = $this->getPart4($tickets);

        return (int)($part1 . $part2 . $part3 . $part4);
    }

    protected function getPart1($date): string
    {
        return substr((string)$date->year, 2, 2);
    }

    protected function getPart2($date): string
    {
        return strlen((string)$date->month) == 1 ? '0' . (string)$date->month : (string)$date->month;
    }

    protected function getPart3($date): string
    {
        return strlen((string)$date->day) == 1 ? '0' . (string)$date->day : (string)$date->day;
    }

    protected function getPart4($tickets): string
    {
        $arrayOfTickets = $tickets->map(function ($item) {
            return $item['serial_number'];
        });

        if (count($arrayOfTickets) < 10) {
            return '00' . (string)(count($arrayOfTickets) + 1);
        } else {
            if (count($arrayOfTickets) < 100) {
                return '0' . (string)(count($arrayOfTickets) + 1);
            } else {
                return (string)(count($arrayOfTickets) + 1);
            }
        }
    }

    protected function generatePrice(Request $request): array
    {
        $from = new Carbon($request->input('valid_from'));
        $to = new Carbon($request->input('valid_to'));
        $lakes = $request->input('lakes');
        $rods = $request->input('rods');

        $days = $from->diffInDays($to);

        $priceForLakes = $this->formatPrice(50 * count($lakes) / 100);
        $priceForDays = $this->formatPrice(10 * ($days + 1) / 100);
        $priceForRods = $this->formatPrice(80 * $rods / 100);

        return [
            "lakes" => $priceForLakes,
            "days" => $priceForDays,
            "rods" => $priceForRods,
            "price" => $this->formatPrice($priceForLakes + $priceForDays + $priceForRods)
        ];
    }

    protected function formatPrice($price): float
    {
        return number_format($price, 2, '.', ' ');
    }
}
