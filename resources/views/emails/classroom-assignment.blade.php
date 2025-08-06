<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            background-color: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2c3e50;
        }
        .content {
            font-size: 16px;
            color: #333333;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #3490dc;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #999999;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <img src="https://png.pngtree.com/png-vector/20230725/ourmid/pngtree-school-logo-design-template-vector-png-image_8668651.png" alt="img" width="100" height="100">
            <h1>Welcome, {{ $teacher->name }}!</h1>
        </div>
        <div class="content">
            <p>We’re excited to have you on board.</p>

            <p>You’ve been assigned as the homeroom teacher for class <strong>{{ $teacher->classroom->name }}</strong>. Please access the system to key in your students details</p>
            <br>
            <p>Thank you!</p>
        </div>
        <div class="footer">
            &copy; {{ now()->year }} SMK Muara Kilau. All rights reserved.
        </div>
    </div>
</body>
</html>
