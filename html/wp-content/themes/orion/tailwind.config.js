/* eslint-disable no-undef */
/* eslint-disable quotes */
module.exports = {
	purge: {
		enabled: true,
		content: ['./**/*.php'],
	},
	darkMode: false, // or 'media' or 'class'
	theme: {
		container: {
			padding: {
				DEFAULT: '1rem',
				sm: '2rem',
				lg: '4rem',
				xl: '5rem',
				'2xl': '6rem',
			},
		},
		extend: {
			// backgroundImage: () => ({
			// 	subscribe: "url('./img/bg_inicioAbajo.jpg')",
			// }),
			fontFamily: {
				body: ["'alto'"],
				altomedium: ["'altomedium'"],
				altobold: ["'altobold'"],
			},
			colors: {
				primary: '#0090F2',
				secondary: '#E6E6E6',
				highlightsRed: '#F23645',
				bgBlueDark: '#07457B',
				bgDarkGray: '#707070',
			},
		},
	},
	variants: {
		extend: {
			flexDirection: ['odd'],
		},
	},
	plugins: [],
};
