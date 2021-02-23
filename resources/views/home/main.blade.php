
@include('index/header')

<link rel="stylesheet" href="{{ asset('css/index-home.css') }}">

<body>  
	<div class="home-frame">
		<div class="top">
			<div class="logo-frame">
				<div class="logo">
					<div class="background rounded">
						<div class="slogen">get the best out of yourself</div>
					</div>
					<div class="text">
						<div>PRIVATE</div>
						<div class="white">TUTOR</div>
						<div>HUNT<span class="uk">.uk</span></div>
					</div>
				</div>
				<div class="tutors"><h2>Private tutors in the UK.</h2></div>
			</div>	
			<div class="enter-frame">
				<a href="/home" >
					<div>
						<h1>for students</h1>
						Click here to find your tutor!
					</div>
				</a>
				<a href="/login">
					<div>
						<h1>for tutors</h1>
						Click here to become a tutor!
					</div>
				</a>
				
			</div>
		</div>	
		<div class="subjects">
			|
			@foreach($dataCategories as $cat)
				@if ($cat->subjects != '')
					<a href="/subjects/{{ $cat->slug }}">{{ strtolower($cat->category_name) }}</a> | 
				@endif
			@endforeach 
		</div>
	</div>
</body>

</html>