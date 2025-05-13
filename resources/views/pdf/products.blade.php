<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Product List') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 40px;
            padding: 20px;
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
            color: #2b6cb0;
            font-weight: bold;
        }

        table td {
            color: #2d3748;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            text-align: center;
            z-index: 10;
            overflow: hidden;
        }

        .footer-bg {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.05;
            width: 200px;
            pointer-events: none;
            z-index: 0;
        }

        .footer-text {
            position: relative;
            z-index: 1;
            font-size: 14px;
            color: #64748b;
            line-height: 150px;
            margin: 0;
        }


    </style>
</head>
<body>
<div class="header">
    <div class="title">{{ __('Benito\'s Fish Markets') }}</div>
</div>

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

    <div class="footer">
        <img src="{{ public_path('images/logo.jpg') }}" alt="PESCADERÍAS BENITO Logo" class="footer-bg">
        <p class="footer-text">{{ __('Benito\'s Fish Markets') }}</p>
    </div>

</div>

</body>
</html>

