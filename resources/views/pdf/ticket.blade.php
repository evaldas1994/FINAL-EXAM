<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>
    <h1>PDF</h1>
</header>

<main>
<section>
    <h3>This is pdf</h3>
    <p>ID: {{ $ticket->id }}</p>
    <p>USER_ID: {{ $ticket->user_id }}</p>
    <p>NAME: {{ $ticket->name }}</p>
    <p>SURNAME: {{ $ticket->surname }}</p>
    <p>EMAIL: {{ $ticket->email }}</p>
    <p>SERIAL_NUMBER: {{ $ticket->serial_number }}</p>
    <p>VALID FROM: {{ $ticket->valid_from }}</p>
    <p>VALID TO: {{ $ticket->valid_to }}</p>
    <p>PRICE: {{ $ticket->price }}</p>
    <p>RODS: {{ $ticket->rods }}</p>
    <p>CREATED AT: {{ $ticket->created_at }}</p>
    <a href="{{ url('dynamic_pdf/pdf') }}">Convert to PDF</a>
</section>
</main>

<footer>
    <p>This is footer</p>
</footer>
</body>
</html>
