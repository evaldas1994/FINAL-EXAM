<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ticket\TicketCreateRequest;
use App\Http\Requests\Api\Ticket\TicketUpdateRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tickets = Ticket::all();

        $ticketService = new TicketService();

        if ($ticketService->is_records_exists($tickets)) {
            return response()->json([
                'success' => true,
                'message' => 'tickets get successfully',
                'data' => $tickets
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'no tickets'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketCreateRequest $request
     * @return JsonResponse
     */
    public function store(TicketCreateRequest $request): JsonResponse
    {
        try {
            $ticket = Ticket::create([
                "user_id" => 1,
                "name" => $request['name'],
                "surname" => $request['surname'],
                "email" => $request['email'],
                "serial_number" => $this->generateSerialNumber(),
                "valid_from" => $request['valid_from'],
                "valid_to" => $request['valid_to'],
                "price" => $this->generatePrice($request)['price'],
                "rods" => $request['rods']
            ]);


            for ($i = 0; $i < count($request['lakes']); $i++) {
                $ticket->lakes()->attach($request['lakes'][$i]['id']);
            }

            return response()->json([
                'success' => true,
                'message' => 'ticket created successfully',
                'data' => $ticket
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $ticket = Ticket::find($id);

        $ticketService = new TicketService();

        if ($ticketService->is_record_exists($ticket)) {
            return response()->json([
                'success' => true,
                'message' => 'ticket found successfully',
                'data' => $ticket
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ticket not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TicketUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TicketUpdateRequest $request, int $id): JsonResponse
    {
        $ticket = Ticket::find($id);

        $ticketService = new TicketService();

        if ($ticketService->is_record_exists($ticket)) {
            try {
                $ticket->update($request->all());

                return response()->json([
                    'success' => true,
                    'message' => 'ticket updated successfully',
                    'data' => $ticket
                ]);

            } catch (Throwable $exception) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage()
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ticket not found'
            ], 404);
        }
    }

    public function price(Request $request): JsonResponse
    {
        return response()->json($this->generatePrice($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $ticket = Ticket::find($id);

        $userService = new TicketService();

        if ($userService->is_record_exists($ticket)) {
            $ticket->delete();

            return response()->json([
                'success' => true,
                'message' => 'ticket deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ticket not found'
            ], 404);
        }
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

        $newSerialNumber = $part1 . $part2 . $part3 . $part4;

        return (integer)$newSerialNumber;
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
        $arrayOfTickets = $tickets->map(function ($item, $key) {
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

    public function generatePrice($request): array
    {
        $from = new Carbon($request['valid_from']);
        $to = new Carbon($request['valid_to']);
        $lakes = $request['lakes'];
        $rods = $request['rods'];

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
        return number_format($price, 2, '.', '');
    }
}
