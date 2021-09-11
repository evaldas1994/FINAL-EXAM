<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use QrCode;
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
        return 'Serial number: '.$ticket->serial_number.'
        Name: '.$ticket->name.'
        Surname: '.$ticket->surname.'
        Valid from: '.$ticket->valid_from.'
        Valid to: '.$ticket->valid_to.'
        Rods: '.$ticket->rods.'
        Lakes: '.$this->generateLakesToString($ticket);
    }

    public function generateLakesToString(Ticket $ticket): string
    {
        $lakes = $ticket->lakes;

        $result = '';

        for ($i=0; $i<count($lakes); $i++) {
            $result .= $lakes[$i]->name.'
                    ';
        }

        return $result;
    }

    public function getQrImage($ticket)
    {
        $image = \QrCode::format('png')
//            ->merge('resources/views/qrcode.blade.php',0.1, true)
            ->size(1200)->errorCorrection('H')
            ->generate($this->generateString($ticket));
        $output_file = '/img/qr-code/'.$ticket->serial_number.'.png';
        Storage::disk('public')->put($output_file, $image); //storage/app/public/img/qr-code/img-1557309130.png
    }
}
