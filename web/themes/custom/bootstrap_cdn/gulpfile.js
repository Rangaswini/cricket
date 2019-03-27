var gulp = require('gulp');
var sass = require('gulp-sass');
var imagemin = require('gulp-imagemin');
var browserSync = require('browser-sync').create();


gulp.task('browser-sync', function() {
  browserSync.init({
    proxy: 'http://localhost:8885/cricket/web'

  });
});

gulp.task('imagemin', function(){
  return gulp.src('com_images/download.jpeg')
  .pipe(imagemin())
  .pipe(gulp.dest('images'))
});

gulp.task('sass', function () {
    return gulp.src('app/scss/style.scss')
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .pipe(gulp.dest('app/css'))
    .pipe(browserSync.reload({stream: true}));

  });
  gulp.task('watch', gulp.parallel('browser-sync',function(done){
    gulp.watch('app/scss/style.scss', gulp.series('sass')); 

  }));
  gulp.task('hello', function() {
    console.log('Hello Zell');
  });
 //gulp.task('defaulter', gulp.parallel('sass', 'watch'));
