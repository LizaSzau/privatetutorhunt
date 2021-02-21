//-----------------------------------------------------------------------------
// Submit delete profile form
//-----------------------------------------------------------------------------

function validate_form_delete() {
	if (document.getElementById('delete').value == 'delete all of my data') return true
	return false
}