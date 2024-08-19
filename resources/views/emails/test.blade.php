<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Mon email</h1>
    <h5>Bonjour {{ $contact['nom'] }},</h5>
    <p>{{ $contact['message'] }}</p>
</body>
</html>