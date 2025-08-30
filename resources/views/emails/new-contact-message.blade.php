<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
        }
        .message-box {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
        .contact-info {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 5px;
        }
        .btn:hover {
            background: #2980b9;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $companyName }}</h1>
        <p>New Contact Message Received</p>
    </div>
    
    <div class="content">
        <h2>Hello Admin,</h2>
        
        <p>A new contact message has been received from your website. Here are the details:</p>
        
        <div class="contact-info">
            <h3>Contact Information:</h3>
            <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
            <p><strong>Email:</strong> <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></p>
            <p><strong>Phone:</strong> <a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a></p>
            <p><strong>Date:</strong> {{ $contactMessage->created_at->format('F d, Y \a\t g:i A') }}</p>
        </div>
        
        <div class="message-box">
            <h3>Message:</h3>
            <p>{{ $contactMessage->message }}</p>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/admin/contact-messages/' . $contactMessage->id) }}" class="btn">View Message in Admin Panel</a>
            <a href="mailto:{{ $contactMessage->email }}?subject=Re: Your message from {{ $companyName }}" class="btn">Reply via Email</a>
        </div>
        
        <p><strong>Quick Actions:</strong></p>
        <ul>
            <li>Click "View Message" to see the full message in your admin panel</li>
            <li>Click "Reply via Email" to respond directly to the customer</li>
            <li>Call the customer at {{ $contactMessage->phone }} if immediate response is needed</li>
        </ul>
    </div>
    
    <div class="footer">
        <p>This is an automated notification from your {{ $companyName }} website.</p>
        <p>Message ID: #{{ $contactMessage->id }}</p>
    </div>
</body>
</html>
