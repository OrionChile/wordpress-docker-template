import AOS from 'aos';
import LazyLoad from 'vanilla-lazyload';

// import css y Sass
import './sass/app.sass';
import 'aos/dist/aos.css';

// components
import './ts/components/index.ts';
import './ts/header/index.ts';
import './ts/scroll.ts';
import './ts/menu.ts';
import './ts/jumpPage.ts';
AOS.init();

// Lazy Load
new LazyLoad({
	elements_selector: '.lazy'
});

document.addEventListener('DOMContentLoaded', function() {
	const loader = document.querySelector<HTMLElement>('.loader_page');
	loader.classList.add('opacity-0');
	loader.style.opacity = '0';
});
