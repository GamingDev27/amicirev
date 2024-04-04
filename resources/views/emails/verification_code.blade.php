<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f3f8;
        }

        main {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 40%;
            margin: 0 auto;
            padding-block: 3rem;
            padding-inline: 4rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #ffff;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
            margin-bottom: 20px;
        }

        footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            padding-block: 2rem;
        }

        .small-text {
            text-align: center;
            font-weight: bold;
            font-size: small;
        }

        .code {
            margin-block: 1rem;
            padding-block: 2rem;
            background-color: #c4c1c1;
            color: #444;
            text-align: center;
            font-weight: 700;
            font-size: 2rem;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <div class="header">{{ $mail['company'] }}</div>
            <div class="content">
                <p>Hi {{ $mail['first_name'] }},</p>
                <p>We have receive a login request from you.</p>
                <p>
                    To complete the sign in, enter the verification code
                    below:
                </p>
                <div class="code">{{ $mail['code'] }}</div>
                <div class="small-text">This code is valid only with 30mins.</div>
                <p>
                    If you did not attempt to sign in to your account, your
                    password may be compromised. Reset your password to
                    prevent unauthorized access to your account.
                </p>
                <p>Thanks,</p>
            </div>
        </div>
    </main>
    <footer>&copy; {{ date("Y") }} amicireviewcenter.com. All rights reserved.</footer>
</body>