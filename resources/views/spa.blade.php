<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Taskly || Your TODO for your company</title>
</head>
<body>
    <div id="app">
        <Home></Home>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>