<?php

namespace App\Http\Controllers;

use QrCode;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;

class QrCodeController extends Controller
{
    public function generateQrCode($id)
    {
        $ticket = Ticket::findOrFail($id);
        $data = $this->generateString($ticket);

        return view('qrcode', compact('data'));
    }

    public function generateString($ticket): string
    {
        return 'Serial number: ' . $ticket->serial_number . '
        Name: ' . $ticket->name . '
        Surname: ' . $ticket->surname . '
        Valid from: ' . $ticket->valid_from . '
        Valid to: ' . $ticket->valid_to . '
        Rods: ' . $ticket->rods . '
        Lakes: ' . $this->generateLakesToString($ticket);
    }

    public function generateLakesToString(Ticket $ticket): string
    {
        $lakes = $ticket->lakes;


        $result = '';

        for ($i = 0; $i < count($lakes); $i++) {
            $result .= $lakes[$i]->name . '
                    ';
        }


        return $result;
    }

    public function getQrImage($ticket): void
    {
        $image = QrCode::format('png')
            ->size(200)->errorCorrection('H')
            ->generate(utf8_decode($this->generateString($ticket)));

        $output_file = '/img/qr-code/' . $ticket->serial_number . '.png';
        Storage::disk('public')->put($output_file, $image);
    }
}
