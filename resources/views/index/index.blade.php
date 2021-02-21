@include('index/header')

<body>  
	<div id="app">
		<div class="header-frame">
			<div class="header">
				@include('index/logo')
			</div>
		</div>	
		
		<div class="nav-frame">
			@include('index/nav')
		</div>	
		
		<div class="content-frame">
			@yield('content')
		</div>
		
		<div class="footer-frame">
			@include('index/footer')
		</div>
	</div>
		
	<div class="modal rounded" id="modal_login">
		<div class="close"><div id="close">x</div></div>
		@if (!isset($user)) @include('auth/login_modal')@endif
	</div>
	
	<link rel="stylesheet" href="{{ asset('css/'.$css_file.'.css') }}">
	<script src="{{ asset('js/index.js') }}"></script>
	<script src="{{ asset('js/'.$js_file.'.js') }}"></script>
	
</body>

</html>