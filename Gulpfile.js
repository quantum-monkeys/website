const gulp = require('gulp');
const imagemin = require('gulp-imagemin');
const pngquant = require('imagemin-pngquant');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

gulp.task('image-min', () => {
    gulp.src([
            'node_modules/fancybox/dist/img/**/*',
            'node_modules/lightslider/dist/img/**/*',
        ])
        .pipe(imagemin({
            progressive: true,
            optimizationLevel: 3,
            svgoPlugins: [
                {removeViewBox: false},
                {cleanupIDs: false}
            ],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('web/img'));

    return gulp.src([
            'app/Resources/images/**/*',
        ])
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
            'node_modules/fancybox/dist/css/jquery.fancybox.css',
            'node_modules/lightslider/dist/css/lightslider.css',
    ])
        .pipe(cleanCSS({debug: true}, function(details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(concat('vendors.min.css'))
        .pipe(gulp.dest('web/css'));

    return gulp.src([
            'app/Resources/styles/style.css',
            'app/Resources/styles/aboutus.css',
            'app/Resources/styles/services.css',
            'app/Resources/styles/custom.css',
            'app/Resources/styles/landing_page.css',
            'app/Resources/styles/testimonials.css',
            'app/Resources/styles/event-modal.css'
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
            'node_modules/jcf/dist/js/jcf.checkbox.js',
            'node_modules/jquery-form/jquery.form.js',
            'node_modules/fancybox/dist/js/jquery.fancybox.js',
            'node_modules/lightslider/dist/js/lightslider.js',
            'node_modules/js-cookie/src/js.cookie.js',
        ])
        .pipe(concat('vendors.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('web/js'));

    return gulp.src([
            'app/Resources/scripts/script.js',
            'app/Resources/scripts/functions.js',
            'app/Resources/scripts/contact.js',
            'app/Resources/scripts/newsletter.js',
        ])
        .pipe(concat('app.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('web/js'));
});

gulp.task('image', ['image-min']);
gulp.task('default', ['css', 'fonts', 'js']);
