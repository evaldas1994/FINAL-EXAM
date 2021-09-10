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

        return view('ticket', compact('ticket', 'lakes'));
    }

    public function createPDF($id)
    {
        $ticket = Ticket::FindOrFail($id);

        $lakes = $ticket->lakes;

        view()->share('pdf.ticket', compact('ticket', 'lakes'));
        $pdf = PDF::loadView('pdf.ticket', compact('ticket', 'lakes'));

        return $pdf->download('pdf_file.pdf');
    }
}
