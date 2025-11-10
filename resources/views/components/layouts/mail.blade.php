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
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
        }
        h1{
            font-size: 2rem;
        }
        h2{
            font-size: 1.75rem;
        }
        h3{
            font-size: 1.5rem;
        }
        p {
            line-height: 1.6;
            margin-bottom: 16px;
        }
        code {
            background: #1e1e1e;
            padding: 2px 4px;
            border-radius: 4px;
            font-family: 'Courier New', Courier, monospace;
        }
        pre {
            background: #1e1e1e;
            padding: 16px;
            border-radius: 6px;
            overflow-x: auto;
            margin-bottom: 16px;
        }
        .email-body a {
            color: #3b82f6;
            text-decoration: none;
        }
        .email-footer a{
            color: white;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        .logo{
            height: 40px;
        }
        blockquote {
            border-left: 4px solid #F7561B;
            padding-left: 16px;
            color: #d1d5db;
            margin: 16px 0;
            font-style: italic;
        }
        
    </style>
</head>
<body class="dark">
    <div class="email-container">
        <div class="email-header">
            <a href="https://geering.dev" target="_blank"><img class="logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAqsAAADNCAYAAACfKTmfAAAACXBIWXMAAA7DAAAOwwHHb6hkAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAIABJREFUeJzt3XmYHFW9xvHv6Z6lJwskAgEyM4msyiai7IuCiLIHCM5MwuZ2LyqIO4JeL+CGG24gylVAkSUzEpAoy0VZlE0EQfaLyJJkJuwEEsh0z1Ln/nGmSSDJTJ3qqq7qnvfzPHl8JHWqTmd6ut86dc7vGGstIiIiIiJZlEu7AyIiIiIia6OwKiIiIiKZpbAqIiIiIpmlsCoiIiIimaWwKiIiIiKZpbAqIiIiIpmlsCoiIiIimaWwKiIiIiKZpbAqIiIiIpmlsCoiIiIimaWwKiIiIiKZpbAqIiIiIpmlsCoiIiIimaWwKiIiIiKZpbAqIiIiIpmlsCoiIiIimaWwKiIiIiKZpbAqIiIiIpmlsCoiIiIimaWwKiIiIiKZpbAqIiIiIpmlsCoiIiIimaWwmg1NQGvanRARERHJGoXV9DUBPcA70+6IiIiISNYorKarCegGZqXdEREREZEsUlhNTyMuqB6WdkdEREREskphNR2NuEf/CqoiIiIio1BYrT4FVREREZGQFFarS0FVRERExIPCavUoqIqIiIh4UlitDi2mEhEREYlAYTV55aB6eNodEREREak1CqvJygMXoaAqIiIiEonCanLywMVAV9odEREREalVCqvJUFAVERERiYHCavzywG9RUBURERGpmMJqvMpBdU7aHRERERGpBwqr8VFQFREREYmZwmo8FFRFREREEqCwWrlyeSoFVREREZGYKaxWphxU56bdEREREZF6pLAanYKqiIiISMIUVqNRUBURERGpAoVVf3ngNyioioiIiCROYdVPOagelXZHRERERMYDhdXwFFRFREREqkxhNRwFVREREZEUKKyOLQ/8GgVVERERkapTWB1dOagenXI/RERERMYlhdW1U1AVERERSZnC6popqIqIiIhkgMLq6hRURURERDJCYfWN8sCFKKiKiIiIZILC6krloHpM2h0REREREach7Q5khIKqyPgyBdgX2AooAM8AtwD3pdkpERFZncKqgqrIeNIEnA6cBExcw9//Dfg0cHcV+yQiIqMY79MA8sAFKKiKjAfrADcDp7LmoAqwK26E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"></a>
            </div>
        <div class="email-body">
            {{ $slot }}
        </div>
        <div class="email-footer">
            <a href="https://geering.dev">https://geering.dev</a> - <a href="mailto:joel@geering.dev">joel@geering.dev</a> - <a href="https://www.linkedin.com/in/joel-geering-333a471b9/">LinkedIn</a>
        </div>
    </div>
</body>
</html>