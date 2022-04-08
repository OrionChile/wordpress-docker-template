if(document.querySelector('.flag-popup')){
	const flags = document.querySelectorAll('.flag-popup');
	flags.forEach(flag => {
		flag.addEventListener('mouseover', ()=> {
			const result = flag.querySelector<HTMLElement>('.result');
			result.classList.add('flex');
			result.classList.remove('hidden');
		});

		flag.addEventListener('mouseleave', ()=> {
			const result = flag.querySelector<HTMLElement>('.result');
			result.classList.remove('flex');
			result.classList.add('hidden');
		});
		
	});

}