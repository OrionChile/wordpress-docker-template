if (document.querySelector('.call_popup')) {
	console.log('call_popup');
	const callsbtns = document.querySelectorAll('.call_popup');
	callsbtns.forEach((callsbtn) => {
		const classpopup = callsbtn.getAttribute('data-popup');
		const mainpopup = document.querySelector('.' + classpopup);
		console.log(mainpopup);

		const cerrar = mainpopup.querySelector('.cerrar');
		callsbtn.addEventListener('click', () => {
			mainpopup.style.transform = 'translate(0px)';
			document.querySelector('body').style.overflow = 'hidden';
		});
		cerrar.addEventListener('click', () => {
			mainpopup.style.transform = 'translate(-100%)';
			document.querySelector('body').style.overflow = 'visible';
		});

		// mainpopup.addEventListener('click', (e)=>{
		//     e.stopPropagation()
		//     console.log(e.target, e.target.classList.contains('.popup_main'))

		//     // mainpopup.classList.remove('active')
		//     document.querySelector('body').style.overflow = 'visible'
		// })
	});
}
