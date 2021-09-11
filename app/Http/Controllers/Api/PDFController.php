<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use PDF;
use App\Models\Ticket;
use Illuminate\View\View;

class PDFController extends Controller
{
    public function createPDF($id)
    {
        $ticket = Ticket::FindOrFail($id);

        $lakes = $ticket->lakes;

        view()->share('pdf.ticket', compact('ticket', 'lakes'));
        $pdf = PDF::loadView('pdf.ticket', compact('ticket', 'lakes'));

        return $pdf->download('pdf_file.pdf');
    }
}
