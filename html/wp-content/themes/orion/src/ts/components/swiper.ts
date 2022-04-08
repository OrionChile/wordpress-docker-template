import Swiper, { Navigation, Pagination, Autoplay } from 'swiper';
import 'swiper/swiper-bundle.min.css';
Swiper.use([Navigation, Pagination, Autoplay]);
const sliderSwipers = document.querySelectorAll('.slider-swiper');
sliderSwipers.forEach((base) => {
	const slideperview = base.getAttribute('slideperview');
	const direction = base.getAttribute('direction');
	const baseSwiperSelector = base.querySelector<HTMLElement>(
		'.swiper-container'
	);
	if (baseSwiperSelector) {
		const sw = new Swiper(baseSwiperSelector, {
			// Optional parameters
			loop: true,
			autoplay: {
				delay: 6000,
			},
			speed: 1500,
			// centeredSlides: true,
			// autoHeight: true,
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 0,
				},
				768: {
					slidesPerView: slideperview ? parseInt(slideperview) : 1,
					spaceBetween: 0,
				},
			},
			// centeredSlides: true,
			// If we need pagination
			direction: direction === 'vertical' ? 'vertical' : 'horizontal',
			pagination: {
				el: base.querySelector<HTMLElement>('.swiper-pagination'),
				type: 'bullets',
			},

			// Navigation arrows
			navigation: {
				prevEl: base.querySelector<HTMLElement>('.swiper-button-prev'),
				nextEl: base.querySelector<HTMLElement>('.swiper-button-next'),
			},
		});
	}
});
