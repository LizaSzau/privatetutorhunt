<div class="modal-flex">
	<div class="left">
		<a href="{{ route('social.oauth', 'facebook') }}">
			<div class="social facebook rounded">
				<img src="{{ asset('images/fa-facebook.png') }}" alt="facebook-login">
				<div class="v-line"></div>
				<div class="">Facebook login</div>
			</div>
		</a>
		 <a href="{{ route('social.oauth', 'google') }}">
			<div class="social google rounded">
				<img src="{{ asset('images/fa-google.png') }}" alt="google-login">
				<div class="v-line"></div>
				<div class="">Google login</div>
			</div>
		</a>
		<a href="{{ route('social.oauth', 'twitter') }}">
			<div class="social twitter rounded">
				<img src="{{ asset('images/fa-twitter.png') }}" alt="twitter-login">
				<div class="v-line"></div>
				<div class="">Twitter login</div>
			</div>
		</a>
	</div>
	<div class="center">
		<div class="line"></div>
		<div class="or">OR</div>
	</div>
	<div class="right">
		<div>SIGN IN WITH</div>
		
		<form method="POST" action="{{ route('login') }}">
			 @csrf
			<div>
				<input type="text" id="email" name="email" placeholder="E-mail">
				<input type="password" id="password" name="password" placeholder="password">
			</div>
			<div class="last-row">
				<div class="remember">
					<div><input type="checkbox" checked="cheked" id="remember" name="remember"></div>
					<div>Remember me</div>
				</div>
				<div class="button"><button>Login</button></div>
			</div>
		</form>
	</div>
</div>
<div class="bottom">
	<div><a href="{{ url('/register') }}">REGISTER NOW</a></div>
	<div><a href="{{ url('/password/reset') }}">FORGOTTEN?</a></div>
</div>
