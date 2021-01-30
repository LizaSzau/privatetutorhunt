//------------------------------------------------------------------------------
// Ajax
//------------------------------------------------------------------------------
function call_ajax_profile(data) {
	document.getElementById('ajax_profile').style.display = 'block'
	document.getElementById('btn_form').style.display = 'none'
	document.getElementById('btn_form_next').style.display = 'none'
	
	let url = 'form/about'
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
		
		let form_div = document.getElementById('hide_form')
		let form_error = document.getElementById('error_form')
			
		if(data.success == 'OK') { 
			let css_type = 'message-success'
			document.getElementById('btn_form_next').style.display = 'block'											
			document.getElementById('pm_about').style.background = '#04ab57'	
			form_error.innerHTML = 'Your data is saved.'
			form_div.className = css_type			
		} else {
			let css_type = 'message-error'
			form_error.innerHTML = 'Please, check and correct the form.'
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
// Submit about form
//-----------------------------------------------------------------------------

function validate_form() {
	let ok = true
	let css_type = 'message-error'
	hide_messages()
	
	if (!validate_title(css_type)) ok = false
	if (!validate_about(css_type)) ok = false
	if (!validate_education(css_type)) ok = false
	if (!validate_experience(css_type)) ok = false
	
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
// validate title
//-----------------------------------------------------------------------------

var title_val = document.getElementById('title')

title_val.addEventListener('keyup', function(e){
	validate_title('message-warning')
	hide_messages()
});

title_val.addEventListener('focusout', function(e){
	validate_title('message-error')
}); 

function validate_title(css_type) {
	var value = title_val.value.trim()

	var title_div = document.getElementById('hide_title')
	var title_error = document.getElementById('error_title')

	if (value == '') {
		title_error.innerHTML  = 'Title must be filled out. Yout do not need to enter your full name. First name is enough.'
		title_div.className = css_type;
		return false;
	} else if (value.length < 20) {
		title_error.innerHTML = 'Please type at leaat 20 characters.'
		title_div.className = css_type;
		return false;		
	} else {
		title_div.className = 'hide'
		title_error.innerHTML  = ''
		return true		
	}
}

//-----------------------------------------------------------------------------
// validate about
//-----------------------------------------------------------------------------
var about_val = document.getElementById('about')

about_val.addEventListener('keyup', function(e){
	validate_about('message-warning')
	hide_messages()
});

about_val.addEventListener('focusout', function(e){
	validate_about('message-error')
}); 

function validate_about(css_type) {
	var value = about_val.value.trim()
	var about_div = document.getElementById('hide_about')
	var about_error = document.getElementById('error_about')

	if (value == '') {
		about_error.innerHTML  = 'Please write something about you.'
		about_div.className = css_type;
		return false;
	} else if (value.length < 100) {
		about_error.innerHTML = 'Please write at least 100 characters.<br>Characters: ' + value.length
		about_div.className = css_type;
		return false;	
	} else if (value.length > 5000) {
		about_val.value = value.substr(0, 5000);
		about_error.innerHTML = 'Please write maximum 5000 characters.<br>Characters: ' + value.length
		about_div.className = css_type;
		return false;		
	} else {
		about_div.className = 'hide'
		about_error.innerHTML  = ''
		return true		
	}
}

//-----------------------------------------------------------------------------
// validate education
//-----------------------------------------------------------------------------

var education_val = document.getElementById('education')

education_val.addEventListener('keyup', function(e){
	validate_education('message-warning')
	hide_messages()
});

education_val.addEventListener('focusout', function(e){
	validate_education('message-error')
}); 

function validate_education(css_type) {
	var value = education_val.value.trim()
	var education_div = document.getElementById('hide_education')
	var education_error = document.getElementById('error_education')

	if (value == '') {
		education_error.innerHTML  = 'Please write something about your education.'
		education_div.className = css_type;
		return false;
	} else if (value.length < 50) {
		education_error.innerHTML = 'Please write at least 50 characters.<br>Characters: ' + value.length
		education_div.className = css_type;
		return false;	
	} else if (value.length > 2000) {
		education_val.value = value.substr(0, 10);
		education_error.innerHTML = 'Please write maximum 2000 characters.<br>Characters: ' + value.length
		education_div.className = css_type;
		return false;		
	} else {
		education_div.className = 'hide'
		education_error.innerHTML  = ''
		return true		
	}
}

//-----------------------------------------------------------------------------
// validate experience
//-----------------------------------------------------------------------------
var experience_val = document.getElementById('experience')

experience_val.addEventListener('keyup', function(e){
	validate_experience('message-warning')
	hide_messages()
});

experience_val.addEventListener('focusout', function(e){
	validate_experience('message-error')
}); 

function validate_experience(css_type) {
	var value = experience_val.value.trim()
	var experience_div = document.getElementById('hide_experience')
	var experience_error = document.getElementById('error_experience')

	if (value == '') {
		experience_error.innerHTML  = 'Please write something about your experience.'
		experience_div.className = css_type;
		return false;
	} else if (value.length < 50) {
		experience_error.innerHTML = 'Please write at least 50 characters.<br>Characters: ' + value.length
		experience_div.className = css_type;
		return false;	
	} else if (value.length > 5000) {
		experience_val.value = value.substr(0, 5000);
		experience_error.innerHTML = 'Please write maximum 5000 characters.<br>Characters: ' + value.length
		experience_div.className = css_type;
		return false;		
	} else {
		experience_div.className = 'hide'
		experience_error.innerHTML  = ''
		return true		
	}
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