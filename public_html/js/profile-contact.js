//------------------------------------------------------------------------------
// Ajax
//------------------------------------------------------------------------------
function call_ajax_profile(data) {
	document.getElementById('ajax_profile').style.display = 'block'
	document.getElementById('btn_form').style.display = 'none'
	document.getElementById('btn_form_next').style.display = 'none'
	
	let url = 'form/contact'
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
		
		document.getElementById('ajax_profile').style.display = 'none'
		document.getElementById('btn_form').style.display = 'block'
	})
	.catch(function(error) {
		 console.log(error);
	});
}

//-----------------------------------------------------------------------------
// Only digits in input text
//-----------------------------------------------------------------------------

function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return false
	return true
}

//-----------------------------------------------------------------------------
// Validate URL
//-----------------------------------------------------------------------------

function isUrl(str) {
	var i = str.search('https://')
	
	if (i == 0) {
		return true
	} else {
		i = str.search('http://')
		if (i == 0) {
			return true
		} else {
			return false
		}
	}
	return false
}

//-----------------------------------------------------------------------------
// Submit contact form
//-----------------------------------------------------------------------------

function validate_form() {
	let ok = true
	let css_type = 'message-error'
	hide_messages()
	
	if (!validate_name(css_type)) ok = false
	if (!validate_phone_1(css_type)) ok = false
	if (!validate_phone_2(css_type)) ok = false
	if (!validate_webpage(css_type)) ok = false
	if (!validate_facebook(css_type)) ok = false
	if (!isContact()) ok = false
	
	if (!ok) {
		let form_div = document.getElementById('hide_form')
		let form_error = document.getElementById('error_form')
		form_error.innerHTML = 'Please check and correct the form.'
		form_div.className = css_type;
		return false
	}
	
	data = new FormData(form_profile)
	call_ajax_profile(data)
	return false
}

//-----------------------------------------------------------------------------
// validate name
//-----------------------------------------------------------------------------

var name_val = document.getElementById('name')

name_val.addEventListener('keyup', function(e){
	validate_name('message-warning')
	hide_messages()
});

name_val.addEventListener('focusout', function(e){
	validate_name('message-error')
}); 

function validate_name(css_type) {
	var value = name_val.value.trim()

	var name_div = document.getElementById('hide_name')
	var name_error = document.getElementById('error_name')

	if (value == '') {
		name_error.innerHTML  = 'Name must be filled out. Yout do not need to enter your full name. First name is enough.'
		name_div.className = css_type;
		return false;
	} else if (value.length < 5) {
		name_error.innerHTML = 'Your name must be at least 5 characters.'
		name_div.className = css_type;
		return false;		
	} else {
		name_div.className = 'hide'
		name_error.innerHTML  = ''
		return true		
	}
}

//-----------------------------------------------------------------------------
// validate phone - 1
//-----------------------------------------------------------------------------

var phone_area_1_val = document.getElementById('phone_area_1')
var phone_number_1_val = document.getElementById('phone_number_1')
	  
phone_area_1_val.addEventListener('keyup', function(e){
	validate_phone_1('message-warning')
	hide_messages()
}); 

phone_number_1_val.addEventListener('keyup', function(e){
	validate_phone_1('message-warning')
	hide_messages()
}); 

phone_number_1_val.addEventListener('focusout', function(e){
	validate_phone_1('message-error')
}); 

function validate_phone_1(css_type) { 
	var value_area_1 = phone_area_1.value.trim()
	var value_number_1 = phone_number_1.value.trim()

	var phone_1_div = document.getElementById('hide_phone_1')
	var phone_1_error = document.getElementById('error_phone_1')
	
	if (value_area_1.length == 0 && value_number_1.length == 0) {
		phone_1_div.className = 'hide'
		phone_1_error.innerHTML  = ''
		return true		
	} else {
		if (value_area_1.length  < 2 || value_number_1.length < 4) {
			phone_1_error.innerHTML  = 'Area code is between 2-5 digits.<br>Phone number is between 4-8 digits.'
			phone_1_div.className = css_type;
			return false	
		} else if (value_area_1.charAt(0) == 0) {
			phone_1_error.innerHTML  = 'Please do not start the area code with 0.'
			phone_1_div.className = css_type;
			return false
		} else {
			phone_1_div.className = 'hide'
			phone_1_error.innerHTML  = ''
			return true		
		}
	}
}

//-----------------------------------------------------------------------------
// validate phone - 2
//-----------------------------------------------------------------------------

var phone_area_2_val = document.getElementById('phone_area_2')
var phone_number_2_val = document.getElementById('phone_number_2')
	  
phone_area_2_val.addEventListener('keyup', function(e){
	validate_phone_2('message-warning')
	hide_messages()
}); 

phone_number_2_val.addEventListener('keyup', function(e){
	validate_phone_2('message-warning')
	hide_messages()
}); 

phone_number_2_val.addEventListener('focusout', function(e){
	validate_phone_2('message-error')
}); 

function validate_phone_2(css_type) { 
	var value_area_2 = phone_area_2.value.trim()
	var value_number_2 = phone_number_2.value.trim()

	var phone_2_div = document.getElementById('hide_phone_2')
	var phone_2_error = document.getElementById('error_phone_2')
	
	if (value_area_2.length == 0 && value_number_2.length == 0) {
		phone_2_div.className = 'hide'
		phone_2_error.innerHTML  = ''
		return true		
	} else {
		if (value_area_2.length  < 2 || value_number_2.length < 4) {
			phone_2_error.innerHTML  = 'Area code is between 2-6 digits.<br>Phone number is between 4-8 digits.'
			phone_2_div.className = css_type
			return false	
		} else if (value_area_2.charAt(0) == 0) {
			phone_2_error.innerHTML  = 'Please do not start the area code with 0.'
			phone_2_div.className = css_type
			return false
		} else {
			phone_2_div.className = 'hide'
			phone_2_error.innerHTML  = ''
			return true		
		}
	}
}

//-----------------------------------------------------------------------------
// validate webpage
//-----------------------------------------------------------------------------

var webpage_val = document.getElementById('webpage')

webpage_val.addEventListener('keyup', function(e){
	validate_webpage('message-warning')
	hide_messages()
});

webpage_val.addEventListener('focusout', function(e){
	validate_webpage('message-error')
}); 

function validate_webpage(css_type) {
	var value = webpage.value

	var webpage_div = document.getElementById('hide_webpage')
	var webpage_error = document.getElementById('error_webpage')

	if (value != '') {
		if (!isUrl(value)) {
			webpage_error.innerHTML  = 'The URL must be started with https:// or https://'
			webpage_div.className = css_type
			return false;	
		} else {
			webpage_div.className = 'hide'
			webpage_error.innerHTML  = ''
			return true
		}
	} else {
		webpage_div.className = 'hide'
		webpage_error.innerHTML  = ''
		return true		
	}
}

//-----------------------------------------------------------------------------
// validate Facebook
//-----------------------------------------------------------------------------

var facebook_val = document.getElementById('facebook')

facebook_val.addEventListener('keyup', function(e){
	validate_facebook('message-warning')
	hide_messages()
});

facebook_val.addEventListener('focusout', function(e){
	validate_facebook('message-error')
}); 

function validate_facebook(css_type) {
	var value = facebook.value

	var facebook_div = document.getElementById('hide_facebook')
	var facebook_error = document.getElementById('error_facebook')

	if (value != '') {
		var i = value.search('facebook')
		if (i == -1) {
			facebook_div.className = 'hide'
			facebook_error.innerHTML  = ''
			return true
		} else {
			facebook_error.innerHTML  = 'Please, type only your user name.'
			facebook_div.className = css_type
			return false;			
		}
	} else {
		facebook_div.className = 'hide'
		facebook_error.innerHTML  = ''
		
		return true		
	}
}

//-----------------------------------------------------------------------------
// IS CONTACT
//-----------------------------------------------------------------------------

function isContact() {	
	if (document.getElementById('email_visible').checked) return true
	if (document.getElementById('email_web').checked) return true
	if (document.getElementById('phone_area_1').value.length > 0) return true
	if (document.getElementById('phone_area_2').value.length > 0) return true
	var phone_2_div = document.getElementById('hide_phone_2')
	var phone_2_error = document.getElementById('error_phone_2')
	
	phone_2_error.innerHTML  = 'Please set enabled one of your e-mail contact type or give your phone number.'
	phone_2_div.className = 'message-error'
	return false
}

//-----------------------------------------------------------------------------
// HIDE MESSAGES IF SOMETHING CHANGES
//-----------------------------------------------------------------------------

function hide_messages() {
	let form_div = document.getElementById('hide_form')
	let form_error = document.getElementById('error_form')
	form_error.innerHTML = ''
	form_div.className = 'hide'
}

//-----------------------------------------------------------------------------
// MEDIA
//-----------------------------------------------------------------------------

//-------------------------------------
// validate Youtube
//-------------------------------------
/*
var c_youtube_val = document.getElementById('c_youtube')

c_youtube_val.addEventListener('keyup', function(e){
	validate_c_youtube('message-warning')
});

c_youtube_val.addEventListener('focusout', function(e){
	validate_c_youtube('message-error')
}); 

function validate_c_youtube(css_type) {
	var value = c_youtube.value

	var youtube_div = document.getElementById('hide_c_youtube')
	var youtube_error = document.getElementById('error_c_youtube')

	if (value != '') {
		var i = value.search('https://www.youtube.com/watch?')
		if (i == 0) {
			youtube_error.innerHTML  = ''
			youtube_div.className = 'hide'
			return true
		} else {
			youtube_error.innerHTML  = 'The link must be started width https://www.youtube.com/watch?'
			youtube_div.className = css_type
			return false;			
		}
	} else {
		youtube_error.innerHTML  = ''
		youtube_div.className = 'hide'
		return true		
	}
}
*/