<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .event-card {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
        }
        .event-name {
            text-align: center;
            margin-bottom: 10px;
        }
        .email {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        .barcode {
            width: 100%;
        }

    </style>
</head>
<body>
    <div class="event-card">
        <h2 class="event-name">{{$event}}</h2>
        <p class="email">{{$email}}</p>
        <p class="email">{{ $price }}</p>
        <p class="email">{{ $name }}</p>
        <img src="{{ asset('barcodes/'.$name.'.png') }}" alt="Barcode">
        {{-- <img src="data:image/png;base64, {{ base64_encode($qrcode->getBarcodePNG($bar, "C39")) }}" alt="Barcode"> --}}
    </div>
</body>
</html>
