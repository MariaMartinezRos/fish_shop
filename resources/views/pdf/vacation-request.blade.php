<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .content {
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
            color: #4CAF50;
        }
        .footer {
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Vacation Request Form</h1>
        </div>
        
        <div class="content">
            <div class="section">
                <p><span class="label">Employee Name:</span> {{ $employee->name }}</p>
                <p><span class="label">Request Date:</span> {{ $requested_at }}</p>
            </div>
            
            <div class="section">
                <p><span class="label">Start Date:</span> {{ $start_date }}</p>
                <p><span class="label">End Date:</span> {{ $end_date }}</p>
            </div>
            
            <div class="section">
                <p><span class="label">Comments:</span></p>
                <p>{{ $comments }}</p>
            </div>
        </div>
        
        <div class="footer">
            <div style="float: left; width: 45%;">
                <p><span class="label">Employee Signature:</span></p>
                <div class="signature-line"></div>
            </div>
            
            <div style="float: right; width: 45%;">
                <p><span class="label">Administrator Signature:</span></p>
                <div class="signature-line"></div>
            </div>
            
            <div style="clear: both;"></div>
        </div>
    </div>
</body>
</html> 