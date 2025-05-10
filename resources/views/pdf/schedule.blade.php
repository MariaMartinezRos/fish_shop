<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('SCHEDULE')}}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
        }
        h1 {
            color: #1e3a8a; /* Darker blue */
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 40px;
        }
        .logo {
            width: 180px;
        }
        .qr-code {
            width: 80px;
        }

        /* Enhanced Schedule Styles */
        .schedule-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .schedule-title {
            color: #1e40af;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .schedule-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            font-size: 16px;
        }
        .schedule-table th {
            background-color: #2563eb;
            color: white;
            padding: 18px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .schedule-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
            font-weight: 500;
        }
        .schedule-table tr:last-child td {
            border-bottom: none;
        }

        .schedule-table tr:hover {
            transition: background-color 0.3s ease;
        }
        .time-slot {
            font-weight: 600;
            color: #1e40af;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header-container">
    <img src="{{ public_path('images/logo.jpg') }}" class="logo" alt="PESCADERÍAS BENITO Logo">
</div>

<div class="schedule-container">
    <h1 class="schedule-title">{{ __('Weekly Work Schedule')}}</h1>
    <table class="schedule-table">
        <thead>
        <tr>
            <th>{{ __('Day')}}</th>
            <th>{{ __('Working Hours')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr><td>{{ __('Tuesday')}}</td><td class="time-slot">8:00 AM - 13:30 PM</td></tr>
        <tr><td>{{ __('Wednesday')}}</td><td class="time-slot">8:00 AM - 13:30 PM</td></tr>
        <tr><td>{{ __('Thursday')}}</td><td class="time-slot">8:00 AM - 13:30 PM</td></tr>
        <tr><td>{{ __('Friday')}}</td><td class="time-slot">8:00 AM - 13:30 PM</td></tr>
        <tr><td>{{ __('Saturday')}}</td><td class="time-slot">8:00 AM - 13:30 PM</td></tr>
        </tbody>
    </table>
    <div class="footer">
        <p>{{ __('This schedule is effective immediately. Please contact HR for any questions.')}}</p>
    </div>
</div>
</body>
</html>
