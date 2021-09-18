<?php

namespace App\Http\Controllers;

use Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function getQrCode($id)
    {
        return QrCode::generate(Request::url("/ticket/{$id}/pdf"));
    }
}
