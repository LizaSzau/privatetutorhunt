//*****************************************************************************
// submit form
//*****************************************************************************

function validate_form() {
	var ok = true
	var css_type = 'message-error'
	if (!validate_name(css_type)) ok = false
	if (!validate_email(css_type)) ok = false
	if (!validate_password(css_type)) ok = false
	if (!validate_password_confirmation(css_type)) ok = false
	
	if (!ok) return false
}

//*****************************************************************************
// validate name
//*****************************************************************************
var name_val = document.getElementById('name')

name_val.addEventListener('keyup', function(e){
	validate_name('message-warning')
}); 
	
name_val.addEventListener('focusout', function(e){
	validate_name('message-error')
}); 

function validate_name(css_type) {
	var name = name_val.value
	var name_div = document.getElementById('hide_name')
	var name_error = document.getElementById('error_name')

	if (name == '') {
		name_error.innerHTML  = 'Name must be filled out.'
		name_div.className = css_type;
		return false;
	} else if (name.length < 5) {
		name_error.innerHTML = 'Name must be at least 5 characters.'
		name_div.className = css_type;
		return false;		
	} else {
		name_error.innerHTML  = ''
		name_div.className = 'hide';
		return true		
	}
}

//*****************************************************************************
// validate e-mail
//*****************************************************************************
var email_val = document.getElementById('email_reg')

email_val.addEventListener('keyup', function(e){
	var email_laravel = document.getElementById('email_laravel')
	email_laravel.className = 'hide'
	validate_email('message-warning')
}); 

email_val.addEventListener('focusout', function(e){
	validate_email('message-error')
}); 


function validate_email(css_type) {
	var email = email_val.value
	var email_div = document.getElementById('hide_email')
	var email_error = document.getElementById('error_email')
	var message
	
	if (!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))) {
		email_error.innerHTML = 'This field requires a valid e-mail address.'
		email_div.className = css_type
		return false;		
	} else {
		email_error.innerHTML  = ''
		email_div.className = 'hide'
		return true	
	}
}

//*****************************************************************************
// validate password
//*****************************************************************************
var password_val = document.getElementById('password_reg')

password_val.addEventListener('keyup', function(e){
	validate_password('message-warning')
}); 

password_val.addEventListener('focusout', function(e){
	validate_password('message-error')
}); 

function validate_password(css_type) {
	var password_1 = document.forms['form_register']['password'].value
	var password_div = document.getElementById('hide_password')
	var password_error = document.getElementById('error_password')
	var message
	
	if (password_1.length < 8) {
		password_error.innerHTML = 'Password must be at least 8 characters.'
		password_div.className = css_type
		return false;		
	} else {
		password_error.innerHTML  = ''
		password_div.className = 'hide'
		return true	
	}
}

//*****************************************************************************
// validate password confirmation
//*****************************************************************************
var password_confirm_val = document.getElementById('password_reg_confirm')

password_confirm_val.addEventListener('keyup', function(e){
	validate_password_confirmation('message-warning')
}); 

password_confirm_val.addEventListener('focusout', function(e){
	validate_password_confirmation('message-error')
}); 

function validate_password_confirmation(css_type) {
	var password_1 = document.forms['form_register']['password'].value
	var password_2 = document.forms['form_register']['password_confirmation'].value
	var password_confirm_div = document.getElementById('hide_password_confirm')
	var password_confirm_error = document.getElementById('error_password_confirm')
	var message
	
	if (password_1 != password_2) {
		password_confirm_error.innerHTML = 'Password confirmation does not match.'
		password_confirm_div.className = css_type
		return false;		
	} else {
		password_confirm_error.innerHTML  = ''
		password_confirm_div.className = 'hide'
		return true	
	}
}