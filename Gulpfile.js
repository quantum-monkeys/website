const gulp = require('gulp');
const imagemin = require('gulp-imagemin');
const pngquant = require('imagemin-pngquant');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

gulp.task('image-min', () => {
    return gulp.src('app/Resources/images/**/*')
        .pipe(imagemin({
            progressive: true,
            optimizationLevel: 3,
            svgoPlugins: [
                {removeViewBox: false},
                {cleanupIDs: false}
            ],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('web/images'));
});

gulp.task('css', () => {
    gulp.src([
            'node_modules/bootstrap/dist/css/bootstrap.min.css',
            'node_modules/font-awesome/css/font-awesome.min.css',
            // 'app/Resources/styles/vendors/simple-line-icons.css',
            // 'app/Resources/styles/vendors/yamm/yamm.css',
            // 'app/Resources/styles/vendors/yamm/menu.css',
            // 'app/Resources/styles/vendors/masterslider/masterslider.css',
            // 'app/Resources/styles/vendors/masterslider/skin/style.css',
            // 'app/Resources/styles/vendors/masterslider/style.css'
        ])
        .pipe(cleanCSS({debug: true}, function(details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(concat('vendors.min.css'))
        .pipe(gulp.dest('web/css'));

    return gulp.src([
            'app/Resources/styles/style.css',
            // 'app/Resources/styles/reset.css',
            // 'app/Resources/styles/orange.css',
            'app/Resources/styles/custom.css'
        ])
        .pipe(cleanCSS({debug: true}, function(details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(concat('app.min.css'))
        .pipe(gulp.dest('web/css'));
});

gulp.task('fonts', () => {
    return gulp.src([
            'node_modules/font-awesome/fonts/*',
            'app/Resources/fonts/*'
        ])
        .pipe(gulp.dest('web/fonts'));
});

gulp.task('js', () => {
    gulp.src([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/jcf/dist/js/jcf.js',
        'node_modules/jcf/dist/js/jcf.select.js',
        'app/Resources/scripts/vendors/responsiveCarousel.min.js',
            // 'app/Resources/scripts/vendors/masterslider/jquery.easing.min.js',
            // 'app/Resources/scripts/vendors/masterslider/masterslider.min.js',
            // 'app/Resources/scripts/vendors/yamm/sticky.js',
            // 'app/Resources/scripts/vendors/scrolltotop/totop.js',
            // 'app/Resources/scripts/vendors/jquery.form.js'
        ])
        .pipe(concat('vendors.min.js'))
        // .pipe(uglify())
        .pipe(gulp.dest('web/js'));

    return gulp.src([
            'app/Resources/scripts/script.js',
            'app/Resources/scripts/functions.js',
        ])
        .pipe(concat('app.min.js'))
        // .pipe(uglify())
        .pipe(gulp.dest('web/js'));
});

gulp.task('image', ['image-min']);
gulp.task('default', ['css', 'fonts', 'js']);
