// Gulp Modules
var gulp = require('gulp');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var rename = require('gulp-rename');
var sass = require('gulp-sass');

// browser-sync task for starting the server.
gulp.task('browser-sync', function () {
	//watch files
	var files = [
    './style.css',
    './*.php',
    './page-templates/*.php',
    './partials/*.php',
    './src/js/*.js'
    ];

	//initialize browsersync
	browserSync.init(files, {
		//browsersync with a php server
		proxy: "http://192.168.33.22/",
		notify: false
	});
});

// Sass task, will run when any SCSS files change & BrowserSync
// will auto-update browsers
gulp.task('sass', function () {
	return gulp.src('assets/css/*.scss')
		.pipe(sass({
			errLogToConsole: true,
			outputStyle: 'compressed'
		}))
		.on('error', swallowError)
		.pipe(rename('style.css'))
		.pipe(gulp.dest('./'))
		.pipe(reload({
			stream: true
		}));
});

// Default task to be run with `gulp`
gulp.task('default', ['sass', 'browser-sync'], function () {
	gulp.watch("assets/css/*.scss", ['sass']);
	gulp.watch("assets/css/bootstrap/*.scss", ['sass']);
	gulp.watch("assets/css/bootstrap/mixins/*.scss", ['sass']);
	gulp.watch("assets/css/modules/*.scss", ['sass']);
	gulp.watch("assets/css/partials/*.scss", ['sass']);
	gulp.watch("assets/css/setup/*.scss", ['sass']);
});



function swallowError(error) {
	// If you want details of the error in the console
	console.log(error.toString())
	this.emit('end')
}