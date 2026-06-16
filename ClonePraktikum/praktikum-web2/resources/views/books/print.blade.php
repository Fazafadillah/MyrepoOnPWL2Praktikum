<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Book</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 30px;
            color: #333;
            background: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead th,
        thead td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }

        tbody td {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #eef3f7;
        }

        img {
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 3px;
            background: white;
        }

        .text-center {
            text-align: center;
        }

        .cover-cell {
            text-align: center;
        }

        @media print {
            body {
                padding: 10px;
            }

            table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <h1>Data Buku</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Publisher</th>
                <th>City</th>
                <th>Cover</th>
                <th>Bookshelf</th>
            </tr>
        </thead>

        <tbody>
            {{ $i = 1 }}

            @foreach ($books as $book)
                <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td class="text-center">{{ $book->year }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->city }}</td>

                    <td class="cover-cell">
                        <img 
                            src="{{ public_path('storage/cover_buku/'. $book->cover) }}" 
                            alt="cover" 
                            width="80px"
                        >
                    </td>

                    <td>{{ $book->bookshelf->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>