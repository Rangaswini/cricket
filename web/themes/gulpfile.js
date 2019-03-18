var gulp = require('gulp');
var sass = require('gulp-sass');
// var browserSync = require('browser-sync').create();
var imagemin = require('gulp-imagemin');



// gulp.task('browser-sync', function() {
//   browserSync.init({
//     server: "./cricket"

//   });
// });
gulp.task('image', function(){
  return gulp.src('bootstrap_cdn/logo.svg)')
  .pipe(imagemin())
  .pipe(gulp.dest('custom/bootstrap_cdn/com_images'))
});

gulp.task('sass', function () {
    return gulp.src('app/scss/style.scss')
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .pipe(gulp.dest('app/css'))
    .pipe(browserSync.reload({
        stream: true
      }))
  

  });
  gulp.task('watch', function(){
    gulp.watch('app/scss/style.scss', gulp.series('')); 
  });
  gulp.task('hello', function() {
    console.log('Hello Zell');
  });
 gulp.task('default', gulp.parallel('myimages'));
