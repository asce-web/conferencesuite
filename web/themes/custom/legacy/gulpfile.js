var gulp = require('gulp')
var pug = require('gulp-pug')
var less = require('gulp-less')
var autoprefixer = require('gulp-autoprefixer')
var clean_css = require('gulp-clean-css')
var sourcemaps = require('gulp-sourcemaps')

gulp.task('pug:index', function () {
  return gulp.src(__dirname + '/legacytest.pug')
    .pipe(pug({
      basedir: './',
      locals: {
      }
    }))
    .pipe(gulp.dest('./'))
})

gulp.task('lessc:legacy', function () {
  return gulp.src(__dirname + '/styles/src/legacy.less')
    .pipe(less())
    .pipe(autoprefixer({
      grid: true,
      cascade: false,
    }))
    .pipe(gulp.dest('./styles/'))
    .pipe(sourcemaps.init())
    .pipe(clean_css())
    .pipe(sourcemaps.write('./')) // write to an external .map file
    .pipe(gulp.dest('./styles/'))
})

gulp.task('build', ['pug:index', 'lessc:legacy'])
