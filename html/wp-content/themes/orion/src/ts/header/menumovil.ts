if(document.querySelector('.menumovil')){
	const menumovil = document.querySelector('.menumovil');
	const cerrar = menumovil.querySelector('.cerrar');
	const btnmovils = document.querySelectorAll('.btn_menumovil');

	btnmovils.forEach(btnmovil => {
		btnmovil.addEventListener('click', ()=>{
			menumovil.classList.add('active');
		});        
	});

	cerrar.addEventListener('click', ()=>{
		menumovil.classList.remove('active');
	});
}