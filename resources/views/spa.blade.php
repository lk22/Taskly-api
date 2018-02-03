<?php
    
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://use.fontawesome.com/5964f513fc.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    @if( auth()->user() )
        <title>Taskly || Home - {{ auth()->user()->name }}</title>
    @else 
        <title>Taskly || Home</title>
    @endif
</head>
<body>
    <div id="app">
    	<router-view></router-view>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://use.fontawesome.com/5964f513fc.js"></script>

</body>
</html>