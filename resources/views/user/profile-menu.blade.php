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
			<div><a href="{{ url('/tutor/profile/locations') }}">Location</a></div>
			<div id="pm_locations" @if ($tutor_ready->location == 1) class="tutor-menu-green" @endif><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/details') }}">Details</a></div>
			<div id="pm_details" @if ($tutor_ready->details == 1) class="tutor-menu-green" @endif><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
		<div class="status-item">
			<div><a href="{{ url('/tutor/profile/activate') }}">Activate</a></div>
			<div @if ($tutor_status == 1) class="tutor-menu-green" @endif><img src="{{ asset('images/fa-tick.png') }}"></div>
		</div>
	</div>
</div>  

