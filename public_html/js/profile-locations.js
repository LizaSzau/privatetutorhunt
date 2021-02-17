const locations_number_max = 3
var locations_number = document.getElementById('locations_number').value
const address_input = document.getElementById('address')

check_hide_form()

//-----------------------------------------------------------------------------
// Scroll to the form
//-----------------------------------------------------------------------------

window.onload = function(e){ 
	const node = document.getElementById('top_form')
	
	window.scrollTo({
	  top: node.offsetTop - 70,
	  behavior: 'smooth',
	})
}

//-----------------------------------------------------------------------------
// Hide form if location number greater than max.
//-----------------------------------------------------------------------------

function check_hide_form() {
	if (locations_number >= locations_number_max) { 
		document.getElementById('hide_max').className = 'hide'
	} else { 
		document.getElementById('hide_max').className = 'show'
	}
}

//-----------------------------------------------------------------------------
// Init map
//-----------------------------------------------------------------------------
/*
function init_map() {
	if (address_input.value != '') {
		show_map(lat.value, lng.value)
	}
}
*/
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
// Display error
//-----------------------------------------------------------------------------

function display_error(div_name, css_type, message) {
	var div = document.getElementById('hide_' + div_name)
	var error = document.getElementById('error_' + div_name)	

	div.className = css_type
	error.innerHTML = message
}

//-----------------------------------------------------------------------------
// Show map Google
//-----------------------------------------------------------------------------

function show_map_google(id) {
 	lat = parseFloat(document.getElementById('lat_' + id).innerHTML)	
 	lng = parseFloat(document.getElementById('lng_' + id).innerHTML)	
	console.log(lat)
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
	
	var map = new google.maps.Map(document.getElementById('map_' + id), options)
	var marker = new google.maps.Marker({
		position: { lat: lat, lng: lng },
		map: map
	})	
}

//-----------------------------------------------------------------------------
// Show map
//-----------------------------------------------------------------------------

function show_map(id) {
	const map = document.getElementById('map_' + id)	
	
	if (map.classList.contains('map-show')) {
		map.className = 'map-hide'
	} else  {
		if (map.innerHTML == '') {
			show_map_google(id)
		}
		map.className = 'map-show'
	}
}

//-----------------------------------------------------------------------------
// Submit location form
//-----------------------------------------------------------------------------

function validate_form() {
	let address = address_input.value.trim()
	let div_name = 'address'
	let css_type = 'hide'
	let message  = ''
	display_error(div_name, css_type, message)	
			
	if (address.length > 0) {
		geocode(address)
	}
	
	return false
}

//-----------------------------------------------------------------------------
// Geocode
//-----------------------------------------------------------------------------

function geocode(address) {
	const geocoder = new google.maps.Geocoder();	
	
	geocoder.geocode({ address: address }, (results, status) => {
		if (status === 'OK') {
			var lat = results[0].geometry.location.lat()
			var lng = results[0].geometry.location.lng()
			call_ajax_profile(lat, lng)
		} else {
			let div_name = 'address'
			let css_type = 'message-error'
			let message  = 'Geocode was not successful.<br>Please check the address.'
			display_error(div_name, css_type, message)				
		}
	})
	
	return false
}

//------------------------------------------------------------------------------
// Ajax
//------------------------------------------------------------------------------

function call_ajax_profile(lat, lng) {
	document.getElementById('ajax_profile').style.display = 'block'
	document.getElementById('btn_row').style.display = 'none'
	document.getElementById('btn_form_next').style.display = 'none'
	
	let data = new FormData(form_profile)
	data.append('lat', lat)
	data.append('lng', lng)

	let url = 'form/locations/upload'
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	
	var address = document.getElementById('address').value
	
	fetch(url, {
		headers: {
			'Accept': 'text-plain',
			'X-CSRF-TOKEN': token
		},
		method: 'post',
		body: data
	})
	.then(response => response.json())
	.then(data => {
		if(data.success == 'OK') { 
			locations_number++
			check_hide_form()
			add_location_DOM(data.location_id, address, lat, lng)
		} else if(data.success == 'IN') { 
			let div_name = 'address'
			let css_type = 'message-error'
			let message  = 'This address has already been added in the list.'
			display_error(div_name, css_type, message)			
		} else {
			let div_name = 'address'
			let css_type = 'message-error'
			let message  = 'Something went wrong. Please try it later.'
			display_error(div_name, css_type, message)		
		}
		document.getElementById('ajax_profile').style.display = 'none'
		document.getElementById('btn_row').style.display = 'block'
		document.getElementById('btn_form_next').style.display = 'block'
	})
	.catch(function(error) {
		let div_name = 'address'
		let css_type = 'message-error'
		let message  = 'Something went wrong with the geocode. Please try it later.'
		display_error(div_name, css_type, message)	
		document.getElementById('ajax_profile').style.display = 'none'
		document.getElementById('btn_form').style.display = 'block'
		document.getElementById('btn_form_next').style.display = 'block'
	});
}

//-----------------------------------------------------------------------------
// Add location DOM
//-----------------------------------------------------------------------------

function add_location_DOM(id, address, lat, lng) {
	
	// button delete
	let node_img_del = document.createElement('img')
	node_img_del.setAttribute('alt', 'delete')
	node_img_del.setAttribute('title', 'delete')
	node_img_del.setAttribute('src', '../../images/fa-trash.png')

	let node_btn_del = document.createElement('button')
	node_btn_del.setAttribute('class', 'btn-delete')
	node_btn_del.appendChild(node_img_del)

	node_btn_del.addEventListener('click', function(e) {
		delete_item(id)
	}, false)
	
	let node_div_flex_1 = document.createElement('div')
	node_div_flex_1.appendChild(node_btn_del)
	
	// button show map
	let node_img_map = document.createElement('img')
	node_img_map.setAttribute('alt', 'delete')
	node_img_map.setAttribute('title', 'delete')
	node_img_map.setAttribute('src', '../../images/fa-map.png')

	let node_btn_map = document.createElement('button')
	node_btn_map.setAttribute('class', 'btn-map')
	node_btn_map.appendChild(node_img_map)
	
	node_btn_map.addEventListener('click', function(e) {
		show_map(id)
	}, false)
	
	let node_div_flex_2 = document.createElement('div')
	node_div_flex_2.appendChild(node_btn_map)
	
	// address
	let node_span_1 = document.createElement('span')
	node_span_1.textContent = address

	let node_span_2 = document.createElement('span')
	node_span_2.setAttribute('id', 'lat_' + id)
	node_span_2.setAttribute('class', 'hide')
	node_span_2.textContent = lat
	
	let node_span_3 = document.createElement('span')
	node_span_3.setAttribute('id', 'lng_' + id)
	node_span_3.setAttribute('class', 'hide')
	node_span_3.textContent = lng
	
	let node_div_flex_3 = document.createElement('div')
	node_div_flex_3.setAttribute('class', 'address')
	node_div_flex_3.appendChild(node_span_1)
	node_div_flex_3.appendChild(node_span_2)
	node_div_flex_3.appendChild(node_span_3)
	
	// map 
	let node_div_map = document.createElement('div')
	node_div_map.setAttribute('id', 'map_' + id)
	node_div_map.setAttribute('class', 'map-hide')	
	
	// put together
	let node_div = document.createElement('div')
	node_div.setAttribute('id', 'location_' + id)
	node_div.setAttribute('class', 'address-flex')
	node_div.appendChild(node_div_flex_1)
	node_div.appendChild(node_div_flex_2)
	node_div.appendChild(node_div_flex_3)
	
	document.getElementById('tutor_locations').appendChild(node_div)
	document.getElementById('tutor_locations').appendChild(node_div_map)
}

//-----------------------------------------------------------------------------
// Delete item
//-----------------------------------------------------------------------------

function delete_item(id) {
	let div_address = document.getElementById('location_' + id)
	let div_map = document.getElementById('map_' + id)
	
	if (id !== -1 && div_address) {
		if (locations_number > 1) {
			div_address.remove()
			div_map.remove()
			locations_number--
			check_hide_form()
			delete_location(id)
		} else {
			document.getElementById('error_delete').innerHTML = 'You can not delete the last location.'
			document.getElementById('hide_delete').className = 'message-error'			
			setTimeout(() => {  
				document.getElementById('error_delete').innerHTML = ''
				document.getElementById('hide_delete').className = 'hide'
			}, 5000)			
		}
	} 
	
	return false
}

//-----------------------------------------------------------------------------
// Delete location POST
//-----------------------------------------------------------------------------

function delete_location(id) {
	let url = 'form/locations/delete'
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	
	let data = new FormData()
	data.append('location_id', id)
	
	fetch(url, {
		headers: {
			'Accept': 'text-plain',
			'X-CSRF-TOKEN': token
		},
		method: 'post',
		body: data
	})
	.then(response => response.json())
	.then(data => {
		// console.log(data)
		document.getElementById('btn_form_next').style.display = 'block'
	})
	.catch(function(error) {
		//console.log(error)
	})
}

//-----------------------------------------------------------------------------
// Call MAP API
//-----------------------------------------------------------------------------

(function(document, tag)	{
	var scriptTag = document.createElement(tag), 
		firstScriptTag = document.getElementsByTagName(tag)[0]
		scriptTag.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDvGPAy77REoDVDsTWdIwrjuw2jkS9HiCY'
		firstScriptTag.parentNode.insertBefore(scriptTag, firstScriptTag);
}(document, 'script'))