<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            }

            th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            }

            th {
            background-color: #dddddd;
            }

    </style>
</head>
<body>
    <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Attendee Status</th>
            <th>Name</th>
            <th>Email</th>
            <th>Event Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($worksheet as $item)

                    <tr>
                        <td>{{ $item[0] }}</td>
                        <td>{{ $item[1] }}</td>
                        <td>{{ $item[2] }}</td>
                        <td>{{ $item[3] }}</td>
                        <td>{{ $item[4] }}</td>
                        <td>{{ $item[5] }}</td>
                        <td>
                            <a href="{{ route('csvFile', ['name' => $item[3]]) }}">Download CSV</a>
                            <a href="{{ route('view', ['name' => $item[3]]) }}">View Tag</a>
                        </td>
                    </tr>

            @endforeach


        </tbody>
      </table>

</body>
</html>
