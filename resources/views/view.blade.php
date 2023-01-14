<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Tag</title>
    <style>
        .event-tag {
            width: 300px;
            height: 200px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .email {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .barcode-svg {
            width: 100%;
            height: 50px;
        }
    </style>
</head>

<body>

    <div class="event-tag">
        <div class="name">{{ $participant_name }}</div>
        <div class="email">{{ $participant_email }}</div>
        <div class="barcode">
            <svg class="barcode-svg"></svg>
        </div>
    </div>

</body>
<script src="{{ asset('view.js') }}"></script>
</html>
