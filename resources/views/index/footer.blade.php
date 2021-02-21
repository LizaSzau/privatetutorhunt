<div class="top">
	<div>
		<div class="left">
			<a href="{{ url('/for-tutors-and-teachers') }}" class="link-white small">for tutors</a>
			<br><a href="{{ url('/contact') }}" class="link-white small">contact</a>
		</div>
		<div class="right">
			<a href="{{ url('/privacy-policy') }}" class="link-white small">privacy policy</a>
			<br><a href="{{ url('/terms-of-service') }}" class="link-white small">terms of service</a>
		</div>
	</div>
</div>
<div class="bottom">
	<div>
		<div class="left">
			<div><img src={{ asset('images/vd.png') }} alt="VividDarer" title="VividDarer"></div>
			<div><a href="https://vividdarer.eu" target="_blank" class="link-white">powered by VividDarer</a></div>
		</div>
		<div class="right">
			© {{ now()->year }} All right reserved
		</div>
	</div>
</div>