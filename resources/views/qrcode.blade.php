<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laravel Generate QR Code Examples</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Simple QR Code</h2>
        </div>
        <div class="card-body">
            {!! QrCode::size(300)->generate($data) !!}
        </div>
    </div>
</div>
</body>
</html>
