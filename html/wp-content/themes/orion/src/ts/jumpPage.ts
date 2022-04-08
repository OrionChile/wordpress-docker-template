import { searchurl } from './components/searchurl';
import jump from 'jump.js';

function detectMobile() {
	return window.innerWidth <= 800 && window.innerHeight <= 600;
}

if (searchurl().li) {
	const scroll = document.querySelector(`#${searchurl().li}`)
		? document.querySelector(`#${searchurl().li}`).getAttribute('scroll')
		: '0';
	const scrollmovil = document.querySelector(`#${searchurl().li}`)
		? document.querySelector(`#${searchurl().li}`).getAttribute('scrollmovil')
		: '0';

	const finalScroll = detectMobile ? parseInt(scrollmovil) : parseInt(scroll);
	jump(`#${searchurl().li}`, {
		duration: 400,
		offset: finalScroll ? finalScroll : 0,
	});
}
