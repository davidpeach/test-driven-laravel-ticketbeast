<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>{{ $concert->title }}</h1>
    <p>{{ $concert->subtitle }}</p>
    <p>{{ $concert->date->format('F j, Y') }}</p>
    <p>{{ $concert->date->format('g:ia') }}</p>
    <p>{{ number_format($concert->ticket_price / 100, 2) }}</p>
    <p>{{ $concert->venue }}</p>
    <p>{{ $concert->venue_address }}</p>
    <p>{{ $concert->city }}</p>
    <p>{{ $concert->state }}</p>
    <p>{{ $concert->zip }}</p>
    <p>{{ $concert->additional_information }}</p>

</body>
</html>
