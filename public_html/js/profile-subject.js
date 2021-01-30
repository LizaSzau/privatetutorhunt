var subject_number = document.getElementById('subject_number').value
var subject_text = ''
var subject_id = 0
var level_text = ''
var level_id = 0

let select_subject = document.getElementById('select_subject')
let select_level = document.getElementById('select_level')

select_subject.addEventListener('change', function(e) {
	  subject_text = this.options[this.selectedIndex].text
	  subject_id = this.options[this.selectedIndex].value
})

select_level.addEventListener('change', function(e) {
	  level_text = this.options[this.selectedIndex].text
	  level_id = this.options[this.selectedIndex].value
})

// fill tutor_subject_level array at start

var tutor_subjects = document.getElementById('tutor_subjects')
var arr_subject_id = []

for (let i = 0; i < tutor_subjects.childNodes.length; i++) {
	if (tutor_subjects.childNodes[i].id) {
		arr_subject_id.push(tutor_subjects.childNodes[i].id)
	}
}

//-----------------------------------------------------------------------------
// Submit subject form - add item
//-----------------------------------------------------------------------------

function validate_form() {
	let ok = true;
	if (subject_id < 1) ok = false;
	if (level_id < 1) ok = false;
	if (arr_subject_id.includes(subject_id + '_' + level_id)) ok = false

	if (ok) {
		add_subject_DOM()
		upload_subject();
	}
	
	return false
}

//-----------------------------------------------------------------------------
// Upload subject POST
//-----------------------------------------------------------------------------

function upload_subject() {
	let url = 'form/subjects/upload'
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	let data = new FormData(form_profile)
	
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
			document.getElementById('btn_form_next').style.display = 'block'											
			document.getElementById('pm_subjects').style.background = '#04ab57'
		} 
		// console.log(data)
	})
	.catch(function(error) {
		  //console.log(error)
	})
}

//-----------------------------------------------------------------------------
// Add subject DOM
//-----------------------------------------------------------------------------

function add_subject_DOM() {
	arr_subject_id.push(subject_id + '_' + level_id)
	subject_number++
	
	let node_img = document.createElement('img')
	node_img.setAttribute('alt', 'delete')
	node_img.setAttribute('title', 'delete')
	node_img.setAttribute('src', '../../images/fa-trash.png')

	let node_btn = document.createElement('button')
	node_btn.appendChild(node_img)
	
	let id = subject_id + '_' + level_id
	
	node_btn.addEventListener('click', function(e) {
		delete_item(id)
	}, false)
	
	let node_span_1 = document.createElement('span')
	node_span_1.setAttribute('class', 'subject')
	node_span_1.textContent = subject_text

	let node_span_2 = document.createElement('span')
	node_span_2.textContent = ' - ' + level_text
	
	let node_div = document.createElement('div')
	node_div.setAttribute('id', subject_id + '_' + level_id)
	node_div.appendChild(node_btn)
	node_div.appendChild(node_span_1)
	node_div.appendChild(node_span_2)
	
	document.getElementById('tutor_subjects').appendChild(node_div)
}

//-----------------------------------------------------------------------------
// Delete item
//-----------------------------------------------------------------------------

function delete_item(id) {
	let index = arr_subject_id.indexOf(id)
	let div = document.getElementById(id)
	
	if (id !== -1 && div) {
		if (subject_number > 1) {
			arr_subject_id.splice(index, 1)
			div.remove()
			subject_number--
			let arr_ids = id.split('_')
			delete_subject(arr_ids[0], arr_ids[1])
		} else {
			document.getElementById('error_delete').innerHTML = 'You can not delete the last subject.'
			document.getElementById('hide_delete').className = 'message-error'			
			setTimeout(() => {  
				document.getElementById('error_delete').innerHTML = ''
				document.getElementById('hide_delete').className = 'hide'
			}, 5000)			
		}
	} 
}

//-----------------------------------------------------------------------------
// Delete subject POST
//-----------------------------------------------------------------------------

function delete_subject(subject_id, level_id) {
	let url = 'form/subjects/delete'
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	let data = new FormData()
	data.append('subject_id', subject_id)
	data.append('level_id', level_id)
	
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
	})
	.catch(function(error) {
		//console.log(error)
	})
}
