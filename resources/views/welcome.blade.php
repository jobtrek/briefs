<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Briefs</title>
    <style>
        /* CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Briefs</h1>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Branch</th>
            <th>Level</th>
            <th>Attachment</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($briefs as $brief)
            <tr>
                <td>{{ $brief->name }}</td>
                <td>{{ $brief->briefBranch->name }}</td>
                <td>{{ $brief->briefLevel->number }}</td>
                <td>
                    @if ($brief->attachment)
                        <a href="{{ asset('storage/' . $brief->attachment) }}" target="_blank">
                            <img src="{{ asset('vendor/filament-panels/pdf-icon.svg') }}" alt="PDF" width="20" height="20">
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
