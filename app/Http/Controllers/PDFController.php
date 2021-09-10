<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Ticket;
use Illuminate\View\View;

class PDFController extends Controller
{
    public function generateTicketView($id): View
    {
        $ticket = Ticket::findOrFail($id);
        $lakes = $ticket->lakes;

        return view('index', compact('ticket', 'lakes'));
    }

    public function createPDF($id)
    {
        $ticket = Ticket::firstOrFail($id);
        $lakes = $ticket->lakes;

        view()->share('index', compact('ticket', 'lakes'));
        $pdf = PDF::loadView('index', compact('ticket', 'lakes'));

        return $pdf->download('pdf_file.pdf');
    }
}
