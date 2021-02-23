<div class="nav">
	<ul>
		<li class="mobile">
			<a href="{{ url('/home') }}" alt="Home" title="Home">
				<img src="{{ asset('images/fa-home.png') }}" class="fa-png" alt="Home">
				<span class="link">Home</span>
			</a>
			<div class="active-menu @if(Route::current()->getName() == 'guest_home') active @endif "></div>
		</li>
		<li class="mobile">
			<a href="{{ url('/subjects') }}" alt="List of subjects" >
				<img src="{{ asset('images/fa-search.png') }}" class="fa-png" alt="List of subjects" title="List of subjects">
				<span class="link">Subjects</span>
			</a>
			<div class="active-menu @if(Route::current()->getName() == 'search') active @endif "></div>
		</li>
		<li>
			<a href="{{ url('/favorites') }}" alt="Favorites">
				<img src="{{ asset('images/fa-favorites.png') }}" class="fa-png" alt="Favorites" title="Favorites">
				<span class="link">Favorites</span>
			</a>
			<div class="active-menu @if(Route::current()->getName() == 'favorites') active @endif "></div>
		</li>
		@guest
		<li>
		@endguest
		@auth
		<li id="user_menu">
		@endauth
			@guest
				<img src="{{ asset('images/fa-login.png') }}" id="img_login" class="fa-png" alt="Login">
				<a id="btn_login" alt="Tutors login">Tutors</a>
			@endguest
			@auth
				@if (Auth::user()->avatar)
					<img src="{{ Auth::user()->avatar }}" class="avatar" title="{{ Auth::user()->name }}">
				@else 
					<img src="{{ asset('images/default-user.png') }}" class="avatar" title="{{ Auth::user()->name }}">
				@endif
				<a>Menu</a>	
				<div class="active-menu @if(Route::current()->getName() == 'user_home') active @endif "></div>		
					<div class="user-menu-items collapsible collapsed">
						<div class="border"></div>
						<a href="{{ url('/tutor/dashboard') }}" @if(Route::current()->getName() == 'user_home') class="active" @endif alt="Dashboard">Info</a>	
						<a href="{{ url('/tutor/profile/welcome') }}" @if(Route::current()->getName() == 'user_profile_contact') class="active" @endif alt="Your profile">Your profile</a>
						<!--<a href="#">History</a>-->
						<a href="{{ url('/tutor/personal-data') }}">Personal data</a>
						<a>
							<form action="{{ url('logout') }}" method="POST">
								{{ csrf_field() }}
								<button type="submit">Logout</button>
							</form>
						</a>
					</div>
			@endauth
		</li>
	</ul>
</div>	