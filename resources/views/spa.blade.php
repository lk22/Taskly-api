<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://use.fontawesome.com/5964f513fc.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title>Taskly || {{ auth()->user()->name }}</title>
    <style>


		#home .app-sidebar #sidebar{
			min-height: 800px;
			width: 100%; 
			border-right: 1px solid #809ed3;
			background: #fff;
			padding:none;
		}

		#home .app-sidebar #sidebar .sidebar__inner{
			padding: 1.5rem;
		}

		#home .app-sidebar #sidebar .sidebar__inner .sidebar__link{
			color: #00b0eb;
			padding-top: 1.5rem;
			padding-left: 0.5rem;
		}

		#home .app-sidebar #sidebar .sidebar__inner .bottom{
			position: absolute;
				bottom: 10px;
				left: 2.5rem;
				color: #00B0EB;
		}
    </style>
</head>
<body>
    <div id="app">
    	<router-view></router-view>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://use.fontawesome.com/5964f513fc.js"></script>
</body>
</html>