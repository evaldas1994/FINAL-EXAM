<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\Ticket;
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
                "serial_number" => $request['serial_number'],
                "valid_from" => $request['valid_from'],
                "valid_to" => $request['valid_to'],
                "price" => $request['price'],
                "rods" => $request['rods']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'lake created successfully',
                'data' => $ticket
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id):JsonResponse
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
            ]);
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
                'message' => 'no ticket found'
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id):JsonResponse
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
            ]);
        }
    }
}
