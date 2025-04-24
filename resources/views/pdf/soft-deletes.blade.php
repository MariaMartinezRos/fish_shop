<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('Soft Deletes Report')}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #004080; /* Dark blue */
            text-align: center;
        }
        .date-range {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #0056b3; /* Medium blue */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 10px;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #b0c4de; /* Light steel blue */
            padding: 5px;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100px;
        }
        th {
            background-color: #4682b4; /* Steel blue */
            color: white;
            font-weight: bold;
        }
        .table-title {
            background-color: #87ceeb; /* Sky blue */
            padding: 10px;
            margin-top: 20px;
            font-weight: bold;
            color: #004080; /* Dark blue */
        }
        .no-records {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            font-style: italic;
        }
        .page-break {
            page-break-after: always;
        }
        @page {
            size: landscape;
            margin: 10mm;
        }
        .page-number:after {
            content: "{{ __('Page ') }}" counter(page);
        }
        footer {
            position: fixed;
            bottom: 0;
            text-align: center;
            width: 100%;
            font-size: 12px;
        }
    </style>
</head>
<body>
<img src="{{ public_path('images/logo.jpg') }}" style="width: 150px;" alt="Logo">
<h1>{{ __('Soft Deletes Report')}}</h1>
<div class="date-range">
    @if(isset($startDate) && isset($endDate))
        {{ __('From:')}} {{ $startDate->format('Y-m-d') }} {{ __('to')}} {{ $endDate->format('Y-m-d') }}
    @else
        {{ __('Date range not specified.')}}
    @endif
</div>

@if(empty($tables))
    <div class="no-records">{{ __('No records have been deleted in this period.')}}</div>
@else
    @foreach($tables as $tableName => $records)
        <div class="table-title">{{ ucfirst($tableName) }}</div>
        @if($records->count() > 0)
            <table>
                <thead>
                <tr>
                    @foreach($records->first() as $key => $value)
                        <th>{{ ucfirst($key) }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($records as $record)
                    <tr>
                        @foreach($record as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="no-records">{{ __('No records deleted in table')}} {{ $tableName }}.</div>
        @endif
        @if(!$loop->last)
            <img src="{{ public_path('images/logo.jpg') }}"
                 style="position: fixed; bottom: 20px; right: 20px; width: 600px; opacity: 0.1; z-index: -1;"
                 alt="Logo">
            <footer>
                <div class="page-number"></div>
            </footer>
            <div class="page-break"></div>
        @endif
    @endforeach
@endif
</body>
</html>
