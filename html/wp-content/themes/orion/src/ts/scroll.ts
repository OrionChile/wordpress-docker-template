window.addEventListener('scroll', () => {
	const scrollactual = window.pageYOffset;
	// console.log(scrollactual);
	if (scrollactual > 560) {
		document.querySelector('.menufixed').classList.add('active');
	} else {
		document.querySelector('.menufixed').classList.remove('active');
	}
});
