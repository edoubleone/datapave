<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f3fef3; color: #155724; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #d4edda; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #0c4128; text-align: center; }
        p { font-size: 16px; line-height: 1.5; }
        strong { color: #0b3e2b; }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {{ $contact->first_name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $contact->message }}</p>
    </div>
</body>
</html>
