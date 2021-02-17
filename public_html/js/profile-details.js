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
// Only digits in input text
//-----------------------------------------------------------------------------

function isNumberKey(evt) {
	const charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return false
	return true
}

//-----------------------------------------------------------------------------
// Hide messages if something changes
//-----------------------------------------------------------------------------

function hide_messages() {
	const form_div = document.getElementById('hide_form')
	const form_error = document.getElementById('error_form')
	form_error.innerHTML = ''
	form_div.className = 'hide'
}

//-----------------------------------------------------------------------------
// Submit contact form
//-----------------------------------------------------------------------------

function validate_form() {
	let ok = true
	let css_type = 'message-error'
	hide_messages()
	
	if (!validate_fee(css_type)) ok = false
	if (!validate_where(css_type)) ok = false
	if (!validate_when(css_type)) ok = false
	ok=true
	if (!ok) {
		let form_div = document.getElementById('hide_form')
		let form_error = document.getElementById('error_form')
		form_error.innerHTML = 'Please check and correct the form.'
		form_div.className = css_type;
		return false
	}

	call_ajax_profile()
	return false
}

//------------------------------------------------------------------------------
// Ajax
//------------------------------------------------------------------------------

function call_ajax_profile(data) {
	let form_div = document.getElementById('hide_form')
	let form_error = document.getElementById('error_form')
		
	document.getElementById('ajax_profile').style.display = 'block'
	document.getElementById('btn_form').style.display = 'none'
	document.getElementById('btn_form_next').style.display = 'none'
	
	var data = new FormData(form_profile)
	
	let url = 'form/details/upload'
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
			document.getElementById('pm_details').style.background = '#04ab57'	
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
		form_error.innerHTML = 'Something went wrong. Please try it later.'
		form_div.className = 'message-error'
		document.getElementById('ajax_profile').style.display = 'none'
		document.getElementById('btn_form').style.display = 'block'
	});
}

//-----------------------------------------------------------------------------
// validate fee
//-----------------------------------------------------------------------------

var fee_in = document.getElementById('fee')

fee_in.addEventListener('keyup', function(e){
	validate_fee('message-warning')
	hide_messages()
}); 

fee_in.addEventListener('focusout', function(e){
	validate_fee('message-error')
}); 

function validate_fee(css_type) { 
	const fee_val = fee_in.value.trim()
	const div = document.getElementById('hide_fee')
	const error = document.getElementById('error_fee')
	
	if (fee_val.length == 0) {
		error.innerHTML  = 'Please enter your fee.'
		div.className = css_type;
		return false	
	} 
	
	div.className = 'hide'
	error.innerHTML  = ''
	return true		
}

//-----------------------------------------------------------------------------
// validate WHERE
//-----------------------------------------------------------------------------

const online_in = document.getElementById('where_online')
const student_in = document.getElementById('where_student_place')
const tutor_in = document.getElementById('where_tutor_place')
	
online_in.addEventListener('click', function(e){
	validate_where()
	hide_messages()
})

student_in.addEventListener('click', function(e){
	validate_where()
	hide_messages()
})

tutor_in.addEventListener('click', function(e){
	validate_where()
	hide_messages()
})

function validate_where() { 
	const div = document.getElementById('hide_where')
	const error = document.getElementById('error_where')
	
	let ok = false
	
	if (online_in.checked ) ok = true
	if (student_in.checked ) ok = true
	if (tutor_in.checked ) ok = true
	
	if (!ok) {
		error.innerHTML  = 'Please choose at least one option.'
		div.className = 'message-error';
		return false	
	} 
	
	div.className = 'hide'
	error.innerHTML  = ''
	return true
}

//-----------------------------------------------------------------------------
// validate WHEN
//-----------------------------------------------------------------------------

const morning_in = document.getElementById('when_morning')
const afternoon_in = document.getElementById('when_afternoon')
const evening_in = document.getElementById('when_evening')
const weekend_in = document.getElementById('when_weekend')
	
morning_in.addEventListener('click', function(e){
	validate_when()
	hide_messages()
})

afternoon_in.addEventListener('click', function(e){
	validate_when()
	hide_messages()
})

evening_in.addEventListener('click', function(e){
	validate_when()
	hide_messages()
})

weekend_in.addEventListener('click', function(e){
	validate_when()
	hide_messages()
})

function validate_when() { 
	const div = document.getElementById('hide_when')
	const error = document.getElementById('error_when')
	
	let ok = false
	
	if (morning_in.checked ) ok = true
	if (afternoon_in.checked ) ok = true
	if (evening_in.checked ) ok = true
	if (weekend_in.checked ) ok = true
	
	if (!ok) {
		error.innerHTML  = 'Please choose at least one option.'
		div.className = 'message-error';
		return false	
	} 
	
	div.className = 'hide'
	error.innerHTML  = ''
	return true
}

//-----------------------------------------------------------------------------
// Textarea
//-----------------------------------------------------------------------------

const comment = document.getElementById('comment')
	
comment.addEventListener('keyup', function(e) {
	hide_messages()
})