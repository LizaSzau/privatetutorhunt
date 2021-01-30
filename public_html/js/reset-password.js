//*****************************************************************************
// submit form
//*****************************************************************************

function validate_form() {
	var ok = true
	var css_type = 'message-error'
	if (!validate_email(css_type)) ok = false
	if (!ok) return false
}

//*****************************************************************************
// validate e-mail
//*****************************************************************************
var email_val = document.getElementById('email_reset')

email_val.addEventListener('keyup', function(e){
	validate_email('message-warning')
}); 

email_val.addEventListener('focusout', function(e){
	validate_email('message-error')
}); 


function validate_email(css_type) {
	var email = document.forms['form_reset_password']['email'].value
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
