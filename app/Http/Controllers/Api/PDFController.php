<?php

namespace App\Http\Controllers\Api;

use PDF;
use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Controllers\QrCodeController;

class PDFController extends Controller
{
    public function createPDF($id)
    {
        $ticket = Ticket::FindOrFail($id);

        $lakes = $ticket->lakes;
        //dd($lakes);

        $qrController = new QrCodeController();
        $qrController->getQrImage($ticket);

        view()->share('pdf.ticket', compact('ticket', 'lakes'));
        $pdf = PDF::loadView('pdf.ticket', compact('ticket', 'lakes'));

        return $pdf->download('pdf_file.pdf');
    }
}
