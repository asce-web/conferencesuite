var gulp = require('gulp')
var pug = require('gulp-pug')
var less = require('gulp-less')
var autoprefixer = require('gulp-autoprefixer')
var clean_css = require('gulp-clean-css')
var sourcemaps = require('gulp-sourcemaps')

gulp.task('pug:test', function () {
  return gulp.src(__dirname + '/proto/legacytest.pug')
    .pipe(pug({
      basedir: './',
      locals: {
      }
    }))
    .pipe(gulp.dest('./proto/'))
})

gulp.task('lessc:core', function () {
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

// IE-only stylesheet. no grid, no minification, no sourcemaps.
gulp.task('lessc:ie', function () {
  return gulp.src(__dirname + '/styles/src/legacy-ie.less')
    .pipe(less())
    .pipe(autoprefixer({ cascade:false }))
    .pipe(gulp.dest('./styles/'))
})

gulp.task('build', ['pug:test', 'lessc:core', 'lessc:ie'])
