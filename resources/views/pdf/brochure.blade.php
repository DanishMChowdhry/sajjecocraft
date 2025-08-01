<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Brochures</title>
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
        }

        table {
            border: 2px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            background: green;
            color: white;
            text-align: left;
            padding: 5px;
            margin: 5px 0;
        }

        .header p {
            text-transform: uppercase;
            margin-left: 20px;
            margin: 0;
        }

        .logo {
            width: 50%;
            height: auto;
        }
    </style>
</head>

<body style="background-image: url('{{ asset('public/frontend/images/brochure_bg.jpg') }}');">

    <img src="{{ $site_settings->logo_dark_image ?? asset('images/default-logo.png') }}" alt="Logo" class="logo">

    <div class="header">
        <p>{{ $category }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="30%">Item Image</th>
                <th width="30%">Particular</th>
                <th width="20%">Size</th>
                <th width="10%">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($products as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        @if(!empty($item['main_image']))
                            <img src="{{ url($item['main_image']) }}" alt="{{ $item['main_image'] }}" width="200px">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{!! $item->short_description !!}</td>
                    <td>{!! mb_convert_encoding($item->size, 'UTF-8', 'UTF-8') !!}</td>
                    <td>Rs.{{ $item->discounted_rates }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
