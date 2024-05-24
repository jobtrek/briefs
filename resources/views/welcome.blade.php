<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandats</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('./images/backjobtrek.png');
            background-size: cover;
            background-repeat: no-repeat;
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 20px;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background-color: rgba(0, 0, 0, 0.7);
        }
        .table td {
            background-color: rgba(0, 0, 0, 0.5);
        }
        .attachment img {
            width: 30px;
            height: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Mandats</h1>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Mandat</th>
            <th scope="col">Description</th>
            <th scope="col">Année</th>
            <th scope="col">Installer</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($briefs as $brief)
            <tr>
                <td>{{ $brief->id }}</td>
                <td>{{ $brief->briefBranch->name }} - {{ $brief->briefLevel->name }}</td>
                <td>{{ $brief->year }}<sup>e</sup> année</td>
                <td class="attachment">
                    @if($brief->attachment)
                        <a href="{{ asset('storage/' . $brief->attachment) }}" target="_blank">
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
