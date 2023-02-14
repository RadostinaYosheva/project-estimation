let loginFrom = document.querySelector('.login-form');

document.querySelector('#btn-login').onclick = () => {
	loginFrom.classList.toggle('active');
	navbar.classList.remove('active');
}

let navbar = document.querySelector('.navbar');

document.querySelector('#btn-menu').onclick = () => {
	navbar.classList.toggle('active');
	loginFrom.classList.remove('active');
}

let login_button = document.getElementById('btn-login');

document.querySelector('#login-button').onclick = () => {
	loginFrom.classList.remove('active');
	login_button.style.display = "none";
}

window.onscroll = () => {
	loginFrom.classList.remove('active');
	navbar.classList.remove('active');
}

var swiper = new Swiper(".event-slide", {
	loop: true,
	spaceBetween: 20,
	autoplay: {
		delay: 7500,
		disableOnInteraction: false,
	},
	breakpoints: {
		0: {
			slidesPerView: 1,
		},
		768: {
			slidesPerView: 2,
		},
		1020: {
			slidesPerView: 3,
		},
	},
});