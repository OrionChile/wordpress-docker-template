const cookies = document.querySelector<HTMLElement>('.cookiemsg');
if (cookies) {
	const cookiebutton = document.querySelector<HTMLElement>('.cookiemsg button');
	cookiebutton.addEventListener('click', () => {
		cookies.style.display = 'none';
	});
}
