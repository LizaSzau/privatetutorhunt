let image_number = document.getElementById('image_number').value
let image_max = 5
let video_number = document.getElementById('video_number').value
let video_max = 2

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

//------------------------------------------------------------------------------
// Get uploaded images
//------------------------------------------------------------------------------

const get_photos = async () => {
let url  = 'images'

await fetch(url)
	.then(response => response.json())
	.then(data => { 
		document.getElementById('photos').innerHTML = ''
		for (var key in data.data.photos) {
			var url ='../../upload/photos/small/' + data.data.photos[key].name
			
			var node = document.createElement('div')
			node.setAttribute('id', data.data.photos[key].id)
			node.setAttribute('class', 'rounded')
			node.style.backgroundImage = 'url(' + url + ')';
			document.getElementById('photos').appendChild(node)
		} 
	})
	.catch(function(error) {
		 //console.log(error)
	});
}

get_photos()

//------------------------------------------------------------------------------
// Order end delete images
//------------------------------------------------------------------------------

dragula([document.querySelector('#photos')], { 
	 removeOnSpill: true 
	}
).on('drop', function(el) {
		photo_order()
	}
).on('remove', function(el) {
		photo_order()
	}
)

function photo_order() {
	let ancestor = document.getElementById('photos')
	let descendents = ancestor.getElementsByTagName('div')
	
	let e
	let images_id = []
	
	for (let i = 0; i < descendents.length; ++i) {
		e = descendents[i];
		images_id.push(e.id)
	}
	
	image_number = images_id.length
	
	if (images_id.length == 0) {
		image_number = 1;
		document.getElementById('error_image').innerHTML = 'You can not delete the last photo.'
		document.getElementById('hide_image').className = 'message-error-image'	
		get_photos()
		
		setTimeout(() => {  
			document.getElementById('error_image').innerHTML = ''
			document.getElementById('hide_image').className = 'hide'
		}, 5000)
	} else {
		let url = 'form/media/photo/order-delete'
		let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		
		var data = new FormData()
		data.append('images_id', images_id)

		fetch(url, {
			headers: {
				'X-CSRF-TOKEN': token
			},
			method: 'post',
			body: data
		})
		.then(response => response.json())
		.then(data => {
			//console.log(data.success)
			document.getElementById('btn_form_next').style.display = 'block'	
		})
		.catch(function(error) {
			//console.log(error)
		})
	}
}

//------------------------------------------------------------------------------
// Upload images
//------------------------------------------------------------------------------

let dropArea = document.getElementById('drop_area')

;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
	dropArea.addEventListener(eventName, preventDefaults, false)
})

function preventDefaults (e) {
	e.preventDefault()
	e.stopPropagation()
}

;['dragenter', 'dragover'].forEach(eventName => {
	dropArea.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => { 
	dropArea.addEventListener(eventName, unhighlight, false)
})

function highlight(e) {
	dropArea.classList.add('highlight')
}

function unhighlight(e) {
	dropArea.classList.remove('highlight')
}

dropArea.addEventListener('drop', handleDrop, false)

function handleDrop(e) {
	let dt = e.dataTransfer
	let files = dt.files

	handleFiles(files)
}

function handleFiles(files) {
	document.getElementById('ajax_drag').style.display = 'block'
	document.getElementById('error_image').innerHTML = ''
	document.getElementById('hide_image').className = 'hide'
	
	files = [...files]
	
	var data = new FormData()
	
	files.forEach(file => {
		if (image_number < image_max) {
			
			let ok = true;

			if (file.type != 'image/jpeg') {
				ok = false
				error_message =  '<div>' + file.name + ': You can upload only JPEG image</div>'
			}
		
			if (file.size > 8000000) {
				ok = false
				error_message =  '<div>' + file.name + ': The image is too large. Image file size is maximum 8 MB</div>'
			}	
	
			if (ok) {
				let name = 'imgfile_' + image_number;
				data.append(name, file)
				image_number++
			} else {
				document.getElementById('error_image').innerHTML += error_message
				document.getElementById('hide_image').className = 'message-error-image'		
				document.getElementById('ajax_drag').style.display = 'none'
			}
		} else {
			document.getElementById('error_image').innerHTML = 'You can upload maximum 5 images.'
			document.getElementById('hide_image').className = 'message-error-image'	
			get_photos()
			
			setTimeout(() => {  
				document.getElementById('error_image').innerHTML = ''
				document.getElementById('hide_image').className = 'hide'
			}, 5000)			
		}
	})
	
	uploadFile(data)
}

function uploadFile(data) {
	let ok = true
	let url = 'form/media/photo/upload'
	let error_message = ''
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

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
			let css_type = 'message-success'
			document.getElementById('btn_form_next').style.display = 'block'											
			document.getElementById('pm_media').style.background = '#04ab57'
			get_photos()
		} 
		document.getElementById('ajax_drag').style.display = 'none'
	})
	.catch(function(error) {
		  //console.log(error)
		  document.getElementById('ajax_drag').style.display = 'none'
	})
}

function check_image_number() {
	if (image_number >= image_max) {
		document.getElementById('frame_image_upload').style.display = 'none'
	} else {
		document.getElementById('frame_image_upload').style.display = 'block'
	}
}

//-----------------------------------------------------------------------------
// VIDEO
//-----------------------------------------------------------------------------

check_video_number()

var btn_video = document.getElementById('btn_video')
btn_video.addEventListener('click', function(e) {
	add_video()
});

var btn_delete_1 = document.getElementById('btn_delete_1')
btn_delete_1.addEventListener('click', function(e) {
	delete_video(this.getAttribute('video_id'), 1)
});

var btn_delete_2 = document.getElementById('btn_delete_2')
btn_delete_2.addEventListener('click', function(e) {
	delete_video(this.getAttribute('video_id'), 2)
});

//-------------------------------------
// Get uploaded videos
//-------------------------------------

const get_videos = async () => {
	document.getElementById('ajax_video').style.display = 'block'
	document.getElementById('frame_video').style.display = 'none'
	let url  = 'videos'

	await fetch(url)
		.then(response => response.json())
		.then(data => { 
			let actual_video = 2;
			for (var key in data.data.videos) { 
				document.getElementById('iframe_' + actual_video).src = 'https://www.youtube.com/embed/' + data.data.videos[key].name
				document.getElementById('btn_delete_' + actual_video).setAttribute('video_id', data.data.videos[key].id)
				document.getElementById('video_' + actual_video).style.display = 'block'
				actual_video--
			} 
			
			document.getElementById('ajax_video').style.display = 'none'
			document.getElementById('frame_video').style.display = 'flex'
		})
		.catch(function(error) {
			 //console.log(error)
			 document.getElementById('ajax_video').style.display = 'none'
			 document.getElementById('frame_video').style.display = 'flex'
		});
}

get_videos()

//-------------------------------------
// Delete video
//-------------------------------------

function delete_video(video_id, actual_video) {
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	let url = 'form/media/video/delete'
	let data = new FormData()
	
	data.append('video_id', video_id)
	
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
			document.getElementById('iframe_' + actual_video).src = ''
			document.getElementById('btn_delete_' + actual_video).setAttribute('video_id', 0)
			document.getElementById('video_' + actual_video).style.display = 'none'
			document.getElementById('btn_form_next').style.display = 'block'	
			
			video_number--
			check_video_number()
		} 
	})
	.catch(function(error) {
		 //console.log(error);
	});	
}

//-------------------------------------
// Add video
//-------------------------------------

function add_video() {
	let video_link = document.getElementById('video').value
	let yt = video_link.substr(0, 32);
	let link_start = 'https://www.youtube.com/watch?v='
	let video_div = document.getElementById('hide_video')
	let video_error = document.getElementById('error_video')
	
	if (yt == link_start) {
		let link = video_link.split('watch?v=')[1]
		video_id = link.split('&')[0]
		let css_type = 'hide'
		video_error.innerHTML  = ''
		video_div.className = css_type
		document.getElementById('video').value = ''
		upload_video(video_id)
	} else {
		let css_type = 'message-error'
		video_error.innerHTML  = 'YouTube video link must be start with: ' + link_start
		video_div.className = css_type
	}
}

//-------------------------------------
// Upload video
//-------------------------------------

function upload_video(video_id) {
	let url = 'form/media/video/upload'
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	let data = new FormData()
	
	data.append('video_id', video_id)
	
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
		if(data.id > 0) { 
			let actual_video = 1
			if (document.getElementById('iframe_1').getAttribute('src') != '') actual_video = 2
			
			document.getElementById('iframe_' + actual_video).src = 'https://www.youtube.com/embed/' + video_id
			document.getElementById('btn_delete_' + actual_video).setAttribute('video_id', data.id)
			document.getElementById('video_' + actual_video).style.display = 'block'
			document.getElementById('btn_form_next').style.display = 'block'	
			
			video_number++
			check_video_number()
		} 
	})
	.catch(function(error) {
		 //console.log(error);
	});
}

//-------------------------------------
// Check video number
//-------------------------------------

function check_video_number() {
	if (video_number >= video_max) {
		document.getElementById('video_link').style.display = 'none'
		document.getElementById('video_button').style.display = 'none'
		document.getElementById('hide_video').style.display = 'none'
	} else {
		document.getElementById('video_link').style.display = 'block'
		document.getElementById('video_button').style.display = 'block'
	}
	
	if (video_number > 0) {
		document.getElementById('frame_video').style.display = 'flex'
	} else {
		document.getElementById('frame_video').style.display = 'none'
	}
}