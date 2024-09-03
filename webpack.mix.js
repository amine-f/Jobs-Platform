const mix = require("laravel-mix");

// Resolve issues with Vue components and other JavaScript files
mix.js("resources/js/app.js", "public/js")
    .vue() // Enable Vue component processing
    .sass("resources/sass/app.scss", "public/css")
    .options({
        processCssUrls: false, // Avoid processing/rewriting URLs in CSS files
    })
    .webpackConfig({
        resolve: {
            extensions: ['.js', '.vue', '.json'], // Ensures proper resolution of .vue files
            alias: {
                'vue$': 'vue/dist/vue.esm.js', // Use the full build of Vue.js
            }
        },
        output: {
            chunkFilename: 'js/[name].js', // Customize chunk filenames for better debugging
        },
    });

// Add versioning to the compiled files to avoid caching issues (optional but recommended)
if (mix.inProduction()) {
    mix.version();
}
