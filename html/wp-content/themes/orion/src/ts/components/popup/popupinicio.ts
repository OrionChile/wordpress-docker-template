if (document.querySelector('.popup_inicio')) {
	const popup = document.querySelector('.popup_inicio');
	const mainpopup = popup.parentElement.parentElement;
	document.querySelector('body').style.overflow = 'hidden';
	const cerrar = popup.querySelector('.cerrar');

	cerrar.addEventListener('click', () => {
		mainpopup.classList.add('hidden');
		document.querySelector('body').style.overflow = 'visible';
	});
}
