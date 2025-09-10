<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #18181b;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #e5e7eb;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #27272a;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.25);
            padding: 32px;
        }
        .email-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .email-header h2 {
            color: #F7561B;
        }
        .email-body {
            color: #e5e7eb;
        }
        .email-footer {
            text-align: center;
            color: #a1a1aa;
            font-size: 13px;
            margin-top: 32px;
        }
    </style>
</head>
<body class="dark">
    <div class="email-container">
        <div class="email-header">
            <h2>{{ $header ?? config('app.name') }}</h2>
        </div>
        <div class="email-body">
            {{ $slot }}
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>