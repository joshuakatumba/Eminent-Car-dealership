<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank you for contacting us</title>
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
        .highlight-box {
            background: #e8f4fd;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.9em;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
        }
        .contact-info {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $companyName }}</h1>
        <p>Thank you for contacting us!</p>
    </div>
    
    <div class="content">
        <h2>Dear {{ $name }},</h2>
        
        <p>Thank you for reaching out to us. We have successfully received your message and our team will review it shortly.</p>
        
        <div class="highlight-box">
            <h3>What happens next?</h3>
            <ul>
                <li>We will review your message within 24 hours</li>
                <li>Our team will respond to your inquiry as soon as possible</li>
                <li>You may receive a follow-up email or phone call from our team</li>
            </ul>
        </div>
        
        <div class="contact-info">
            <h3>Our Contact Information:</h3>
            <p><strong>Phone:</strong> +256 774 959 446</p>
            <p><strong>Email:</strong> info@eminent.com</p>
            <p><strong>Working Hours:</strong> Mon - FRI / 9:30 AM - 6:30 PM</p>
        </div>
        
        <p>If you have any urgent inquiries, please feel free to call us directly at the number above.</p>
        
        <p>Thank you for choosing {{ $companyName }}. We look forward to assisting you!</p>
        
        <p>Best regards,<br>
        <strong>The {{ $companyName }} Team</strong></p>
    </div>
    
    <div class="footer">
        <p>This is an automated response to your contact form submission.</p>
        <p>If you did not submit this contact form, please ignore this email.</p>
        <p>&copy; {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
    </div>
</body>
</html>
