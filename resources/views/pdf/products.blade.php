<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Product List') }}</title>
    <style>
        /* Tailwind-inspired custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #3182ce;
            color: white;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .title {
            font-size: 24px;
            font-weight: bold;
        }

        .header .logo {
            max-width: 100px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #2d3748;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #e2e8f0;
        }

        table th {
            background-color: #ebf8ff;
            color: #2b6cb0;
            font-weight: bold;
        }

        table td {
            background-color: #f7fafc;
            color: #2d3748;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            color: #4a5568;
        }

        .footer p {
            margin: 0;
        }

        /* Prevent page break inside the table rows */
        table td, table th {
            word-wrap: break-word;
            hyphens: auto;
        }
    </style>
</head>
<body>
<!-- Header -->
<div class="header">
{{--    <img class="{{ __('Benito\'s Fish Markets') }}" src="{{ asset('images/favicon-32x32.png') }}" alt="{{ __('Benito\'s Fish Markets') }}">--}}
    <div class="title">{{ __('Benito\'s Fish Markets') }}</div>
</div>

<!-- Content Container -->
<div class="container">
    <h1>{{ __('Products') }}</h1>
    <table>
        <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('NAME') }}</th>
            <th>{{ __('CATEGORY') }}</th>
            <th>{{ __('PRICE (€/KG)') }}</th>
            <th>{{ __('STOCK (KG)') }}</th>
            <th>{{ __('DESCRIPTION') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? __('messages.no_category') }}</td>
                <td>{{ $product->price_per_kg }}</td>
                <td>{{ $product->stock_kg }}</td>
                <td>{{ $product->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Footer -->
<div class="footer">
    <p>{{ __('Benito\'s Fish Markets') }}</p>
</div>
</body>
</html>


