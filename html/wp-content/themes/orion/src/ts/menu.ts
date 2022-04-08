import jump from 'jump.js';

const menus = document.querySelectorAll('.menuwp');
const baseUrl = (document.querySelector('#homepage') as HTMLInputElement).value;

function detectMobile() {
	return window.innerWidth <= 800;
}

menus.forEach((menu) => {
	const classes = [...menu.classList]
		.filter((e) => e.startsWith('__'))[0]
		.split('_');
	if (classes.length > 3) {
		const slug = classes[2];
		const anchor = classes[3];
		if (window.location.href.search(`${baseUrl}/${slug}`) !== -1) {
			menu.querySelector('a').setAttribute('href', '#');
			console.log('anchor ', anchor);
			const scroll = document.querySelector(`#${anchor}`)
				? document.querySelector(`#${anchor}`).getAttribute('scroll')
				: '0';
			const scrollmovil = document.querySelector(`#${anchor}`)
				? document.querySelector(`#${anchor}`).getAttribute('scrollmovil')
				: '0';

			const finalScroll = detectMobile
				? parseInt(scrollmovil)
				: parseInt(scroll);

			menu.addEventListener('click', () => {
				jump(`#${anchor}`, {
					duration: 400,
					offset: finalScroll ? finalScroll : 0,
				});
				console.log('finalScroll', finalScroll);
				if (document.querySelector('.menumovil').classList.contains('active')) {
					document.querySelector('.menumovil').classList.remove('active');
				}
			});
		} else {
			menu
				.querySelector('a')
				.setAttribute('href', `${baseUrl}/${slug}?li=${anchor}`);
		}
	}
});
