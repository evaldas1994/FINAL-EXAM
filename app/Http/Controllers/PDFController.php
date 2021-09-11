<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Ticket;
use Illuminate\View\View;

class PDFController extends Controller
{
//    public function generateTicketView($id): View
//    {
//        $qrController = new QrCodeController();
//        $ticket = Ticket::findOrFail($id);
//        $lakes = $ticket->lakes;
//        $qr = $qrController->generateString($ticket);
//
//
//        return view('pdf.ticket', compact('ticket', 'lakes', 'qr'));
//    }

    public function createPDF($id)
    {
        $qrController = new QrCodeController();
        $ticket = Ticket::FindOrFail($id);
        $qrController->getQrImage($ticket);
        $lakes = $ticket->lakes;
        $qr = $qrController->generateString($ticket);


        view()->share('pdf.ticket', compact('ticket', 'lakes', 'qr'));
        $pdf = PDF::loadView('pdf.ticket', compact('ticket', 'lakes', 'qr'));

        return $pdf->download('pdf_file.pdf');
    }
}
