<div class="frame-tutor-status">
	<div class="status-main">
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/contact') }}">Contact</a></div>
			<div id="pm_contact" @if ($tutor_ready->contact == 1) class="tutor-menu-green" @endif><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/about') }}">About you</a></div>
			<div id="pm_about" @if ($tutor_ready->about == 1) class="tutor-menu-green" @endif><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/media') }}">Media</a></div>
			<div id="pm_media" @if ($tutor_ready->media == 1) class="tutor-menu-green" @endif><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/subjects') }}">Subjects</a></div>
			<div id="pm_subjects" @if ($tutor_ready->subjects == 1) class="tutor-menu-green" @endif><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/locations') }}">Locations</a></div>
			<div id="pm_locations" @if ($tutor_ready->locations == 1) class="tutor-menu-green" @endif><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/contact') }}">Details</a></div>
			<div><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/contact') }}">Active</a></div>
			<div><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
	</div>
</div>  

