module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
        
    ],
    theme: {
        extend: {
            rotate: {
                '15': '15deg',
            },
            margin: {
                '15': '60px',
            },
            spacing: {
                '15': '60px',
            },
        },
    },
    plugins: [
        require('tailwind-scrollbar'),
    ],
}

