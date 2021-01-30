const preloader = document.querySelector('.preloader')
const check_state = 0

//----------------------------------------------------------------------------
// Fade when page loading
//----------------------------------------------------------------------------

function fadeEffect() {
	setInterval(() => {
		if (!preloader.style.opacity) {
			preloader.style.opacity = 1
		}
		if (preloader.style.opacity > 0) {
			preloader.style.opacity -= 0.1
		} else {
			clearInterval(fadeEffect);
			preloader.style.zIndex = '-100'
		}
	}, 100);
}

window.addEventListener('load', fadeEffect);

//-----------------------------------------------------------------------------
// Modal window - click outside and close 
//-----------------------------------------------------------------------------

if (document.querySelector('#user_menu')) {
	document.querySelector('#user_menu').addEventListener('click', function() {
		document.querySelector('.collapsible').classList.toggle('collapsed');
	});
}

//-----------------------------------------------------------------------------
// Modal window - click outside and close 
//-----------------------------------------------------------------------------

let btn_open = document.getElementById('btn_login')
let img_open = document.getElementById('img_login')
let modal = document.getElementById('modal_login')
let app = document.getElementById('app')
let btn_close = document.getElementById('close')

if (btn_open != null) {
	btn_open.onclick = function() { 
		modal.classList.add('modal-display')
		app.classList.add('modal-blur')
	}
}

if (img_open != null) {
	img_open.onclick = function() { 
		modal.classList.add('modal-display')
		app.classList.add('modal-blur')
	}
}

window.onclick = function(event) {
	let act = event.target

    if (act != modal && !modal.contains(act) && act != btn_open && act != img_open || act == btn_close ) {
		modal.className = ''
		modal.classList.add('modal')
		app.className = ''
    }
}
