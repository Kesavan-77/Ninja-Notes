<!-- resources/views/emails/professional_notification.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Notification</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            width: 100%;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        .header {
            text-align: center;
            padding: 20px;
            background-color: #007BFF;
            color: #ffffff;
        }
        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 26px;
            margin: 0;
            font-weight: normal;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            font-size: 22px;
            color: #333333;
            margin-bottom: 15px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
        }
        .content a {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }
        .content a:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #888888;
            background-color: #f1f1f1;
            border-top: 1px solid #dddddd;
        }
        .social-icons {
            margin: 10px 0;
        }
        .social-icons a {
            display: inline-block;
            margin: 0 5px;
            text-decoration: none;
        }
        .social-icons img {
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Ninja Notes</h1>
        </div>
        <div class="content">
            <h2>Hello, {{ $user->name }}</h2>
            <p>Your registration is successfull</p>
            <a href="#">View Details</a>
        </div>
        <div class="footer">
            <p>Thank you for using our application!</p>
        </div>
    </div>
</body>
</html>