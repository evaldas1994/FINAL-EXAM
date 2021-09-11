<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        table {
            width: 100%;
            text-align: center;
        }
        table {
            padding: 20px;
        }

        .text-left {
            text-align: left;
        }

        .qr-code {
            width: 300px;
            height: 300px;
            margin-left: auto;
            margin-bottom: auto;
        }
        p {
            margin: 5px;
        }
        img {
            width: 300px;
            height: 300px;
        }
    </style>
</head>

<body>
<div class="container">
    <table>
        <tr>
            <th><h1>Licence to fishing</h1></th>
        </tr>
        <tr>
            <td><h3>Serial: {{ $ticket->serial_number }}</h3></td>
        </tr>
    </table>

    <table>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="text-left">
                            <p>Name:</p>
                        </td>

                        <td class="text-left">
                            <p>{{ $ticket->name }}</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-left">
                            <p>Surname:</p>
                        </td>

                        <td class="text-left">
                            <p>{{ $ticket->surname }}</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-left">
                            <p>Valid from:</p>
                        </td>

                        <td class="text-left">
                            <p>{{ $ticket->valid_from }}</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-left">
                            <p>Valid to:</p>
                        </td>

                        <td class="text-left">
                            <p>{{ $ticket->valid_to }}</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-left">
                            <p>Rods:</p>
                        </td>

                        <td class="text-left">
                            <p>{{ $ticket->rods }}</p>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-left">
                            <p>Lakes:</p>
                        </td>

                        <td class="text-left">
                            @for ($i = 0; $i < count($lakes); $i++)
                                <p>{{ $lakes[$i]->name }} ({{ $lakes[$i]->region->name }})</p>
                            @endfor
                        </td>
                    </tr>
                </table>
            </td>
            <td>
{{--                <div class="qr-code">--}}
{{--                    {!! QrCode::size(300)->generate('try it it ti ti tit ti tit it ti tit it it t i') !!}--}}
{{--                </div>--}}

{{--                <div class="qr-code">--}}
{{--                    {!! QrCode::size(300)->generate($qr) !!}--}}
{{--                    <a class="" href="{{ URL::to('/ticket/'.$ticket->id.'/pdf') }}">Export to PDF</a>--}}
{{--                </div>--}}

{{--                <div class="qr-code">--}}
{{--                    <img src="https://dummyimage.com/300x300/ccc" alt="1">--}}
{{--                </div>--}}
{{--                <div class="qr-code">--}}
{{--                    <img src="{{ asset('storage/img/qr-code/947081712.png') }}" alt="4">--}}
{{--                </div>--}}
                <div class="qr-code">
                    <img src="{{ public_path('storage/img/qr-code/'.$ticket->serial_number.'.png') }}" alt="5">
                </div>
            </td>
        </tr>
    </table>
</div>

<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
