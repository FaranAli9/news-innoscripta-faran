/** @type {import('tailwindcss').Config} */
export default {
	prefix: 'tw-',
	content: ['./index.html', './src/**/*.{js,ts,jsx,tsx}'],
	theme: {
		extend: {
			colors: {
				primary: '#115d78'
			}
		}
	},
	plugins: [],
	corePlugins: {
		preflight: false
	}
}
