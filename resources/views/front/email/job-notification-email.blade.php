<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Notification Email</title>
</head>
<body>
    <h1>Hello {{ $mailData['employer']->name }}</h1>
    
    <p>Job title {{ $mailData['job']->title }}</p>

    <p>Employee Detail:</p>

    <p>Name: {{ $mailData['user']->name }}</p>
    <p>Email: {{ $mailData['user']->email }}</p>
    <p>Mobile Number: {{ $mailData['user']->mobile }}</p>
</body>
</html>