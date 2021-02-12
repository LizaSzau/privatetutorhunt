var btn_check_address = document.getElementById('btn_check_address')
var address_input = document.getElementById('address')
var address_checked = false
var lat = document.getElementById('lat')
var lng = document.getElementById('lng')

//-----------------------------------------------------------------------------
// Init map
//-----------------------------------------------------------------------------

function init_map() {
	if (address_input.value != '') {
		show_map(lat.value, lng.value)
	}
}

//-----------------------------------------------------------------------------
// Address keyup delete message
//-----------------------------------------------------------------------------

address_input.addEventListener('keyup', function(e) {
	let div_name = 'address'
	let css_type = 'hide'
	let message  = ''
	display_error(div_name, css_type, message)
	address_checked = false
});

//-----------------------------------------------------------------------------
// Click on check button
//-----------------------------------------------------------------------------

btn_check_address.addEventListener('click', function(e) { 
	var address = address_input.value.trim()
	
	if (address.length > 0) {
		let div_name = 'form'
		let css_type = 'hide'
		let message  = ''
		display_error(div_name, css_type, message)
		geocode(address)
	} else {
		let div_name = 'address'
		let css_type = 'message-error'
		let message  = 'Please enter your address.'
		display_error(div_name, css_type, message)		
	}
});

//-----------------------------------------------------------------------------
// Geocode
//-----------------------------------------------------------------------------

function geocode(address) {
	const geocoder = new google.maps.Geocoder();	
	
	geocoder.geocode({ address: address }, (results, status) => {
		if (status === 'OK') {
			let div_name = 'address'
			let css_type = 'message-success'
			let message  = 'Geocode was successful.<br>Please check the address.'
			display_error(div_name, css_type, message)	
		
			lat.value = results[0].geometry.location.lat()
			lng.value = results[0].geometry.location.lng()
			address_checked = true
			show_map(lat.value, lng.value)
		} else {
			let css_type = 'message-error'
			message  = 'Geocode was not successful.<br>Please check the address.'
			map_error(css_type, message)
			address_checked = false
		}
	})
}

//-----------------------------------------------------------------------------
// Geocode
//-----------------------------------------------------------------------------

function display_error(div_name, css_type, message) {
	var div = document.getElementById('hide_' + div_name)
	var error = document.getElementById('error_' + div_name)	

	div.className = css_type
	error.innerHTML = message
}

//-----------------------------------------------------------------------------
// Show map
//-----------------------------------------------------------------------------

function show_map(lat, lng) {
	lat = parseFloat(lat)
	lng = parseFloat(lng)
	
	var options = {     
		zoom: 12,
		center: { lat: lat, lng: lng },
		mapTypeControl: false,
		zoomControl: true,
		zoomControlOptions: 
		{
		  style: google.maps.ZoomControlStyle.SMALL
		},
		streetViewControl: false,
		fullscreenControl: false,
	}
	var map = new google.maps.Map(document.getElementById('map'), options)
	var marker = new google.maps.Marker({
		position: { lat: lat, lng: lng },
		map: map
	})	
}

//-----------------------------------------------------------------------------
// Submit contact form
//-----------------------------------------------------------------------------

function validate_form() {
	let address = address_input.value.trim()
	let div_name = 'form'
	let ok = true

	if (address.length < 1) {
		ok = false
		let css_type = 'message-error'
		let message  = 'Please enter your address.'
		display_error(div_name, css_type, message)		
	}

	if (!address_checked) {
		ok = false
		let css_type = 'message-error'
		let message  = 'Please click on the yellow button and check your address on the map.'
		display_error(div_name, css_type, message)		
	}
	
	if (ok) {
		data = new FormData(form_profile)
		call_ajax_profile(data)
	}
	
	return false
}

//------------------------------------------------------------------------------
// Ajax
//------------------------------------------------------------------------------

function call_ajax_profile(data) {
	document.getElementById('ajax_profile').style.display = 'block'
	document.getElementById('btn_form').style.display = 'none'
	document.getElementById('btn_form_next').style.display = 'none'
	
	let div_name = 'form'
	let css_type = 'hide'
	let message  = ''
	display_error(div_name, css_type, message)	
		
	div_name = 'address'
	display_error(div_name, css_type, message)	
	
	let url = 'form/location'
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

	fetch(url, {
		headers: {
			//'Content-Type': 'application/json',
			//'X-Requested-With': 'XMLHttpRequest',
			'Accept': 'text-plain',
			'X-CSRF-TOKEN': token
		},
		method: 'post',
		body: data
	})
	.then(response => response.json())
	.then(data => {
		
		let form_div = document.getElementById('hide_form')
		let form_error = document.getElementById('error_form')
			
		if(data.success == 'OK') { 
			let css_type = 'message-success'
			document.getElementById('btn_form_next').style.display = 'block'											
			document.getElementById('pm_contact').style.background = '#04ab57'	
			form_error.innerHTML = 'Your data is saved.'
			form_div.className = css_type			
		} else {
			let css_type = 'message-error'
			form_error.innerHTML = 'Please check and correct the form.'
			form_div.className = css_type			
		}
		//console.log(data.success);
		document.getElementById('ajax_profile').style.display = 'none'
		document.getElementById('btn_form').style.display = 'block'
	})
	.catch(function(error) {
		//console.log(error)
		let div_name = 'form'
		let css_type = 'message-error'
		let message  = 'Something went wrong. Please try it later.'
		display_error(div_name, css_type, message)	
	});
}

//-----------------------------------------------------------------------------
// Call MAP API
//-----------------------------------------------------------------------------

(function(document, tag)	{
	var scriptTag = document.createElement(tag), 
		firstScriptTag = document.getElementsByTagName(tag)[0]
		scriptTag.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDvGPAy77REoDVDsTWdIwrjuw2jkS9HiCY&callback=init_map'
		firstScriptTag.parentNode.insertBefore(scriptTag, firstScriptTag);
}(document, 'script'))