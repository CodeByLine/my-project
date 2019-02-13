var gulp = require('gulp');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
// const { watch } = require('gulp-watch');

gulp.task('hello', function() {
  console.log('Hello Zell');
  return new Promise(function(resolve, reject) {
    console.log("HTTP Server Started");
    resolve();
  });

})

gulp.task('sass', function(done) {
  return gulp.src('app/scss/**/*.scss') // Gets all files ending with .scss in app/scss and children dirs
    .pipe(sass())
    .pipe(gulp.dest('app/css'))
    .on('end', done);
    
})


gulp.task('watch', function(){
  gulp.watch('./app/scss/**/*.scss', gulp.series('sass'));
  // gulp.watch('app/scss/**/*.sass', gulp.series['sass']);
  // done();
  
});







