<!doctype html>

<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
		<link rel="shortcut icon" href="{{ asset('images/favicon-32.png') }}">
		<link rel="stylesheet" href="{{ asset('css/index.css') }}">
		
      <!-- Styles -->
        <style>
			.frame { height: 100%; }
			.frame > div { width: 50%; float: left; height: 100vh; padding: 60px; 20px; font-weight: normal; }
			.frame .left { background: var(--yellow); color: var(--blue-dark); font-size: 30px; }
			.frame .right { background: url({{ asset('images/error-1.jpg') }}) no-repeat center center;
				-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }
			h1 { color: var(--white); font-family: 'Heebo', sans-serif; font-weight: 900; line-height: 60px; font-size: 60px; margin-bottom: 60px;}
			button { margin-top: 80px; }

			@media (max-width: 960px) { 
				.frame > div { width: 100%; float: left; height: auto; }
				.frame .right { height: 500px; background: url({{ asset('images/error.jpg') }}) no-repeat center center; 
					-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }
			}

        </style>			
    </head>

    <body>
		<div class="frame">
			<div class="left">
				@yield('message')
				<br><a href="javascript:history.back()"><button>A chance to get back</button></a>
			</div>
			<div class="right"></div>
		</div>
    </body>
</html>
