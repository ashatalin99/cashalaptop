
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      './**/*.php', // Includes all PHP files in your theme
      './scripts/**/*.{js}', // Adjust for your JavaScript files
    ],
    theme: {
        screens: {
            sm: '320px',
            md: '768px',
            lg: '1024px',
            xl: '1920px',
          },  
        extend: {},
    },
    plugins: [],
  };