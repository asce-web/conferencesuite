const path = require('path')

const kss          = require('kss')
const gulp         = require('gulp')
const pug          = require('gulp-pug')
const less         = require('gulp-less')
const autoprefixer = require('gulp-autoprefixer')
const clean_css    = require('gulp-clean-css')
const sourcemaps   = require('gulp-sourcemaps')

gulp.task('test', async function () {
  return gulp.src(__dirname + '/proto/legacytest.pug')
    .pipe(pug({
      basedir: './',
      locals: {
      }
    }))
    .pipe(gulp.dest('./proto/'))
})

// HOW-TO: https://github.com/kss-node/kss-node/issues/161#issuecomment-222292620
gulp.task('docs', async function () {
  return kss(require('./kss.config.json'))
})

gulp.task('dist', async function () {
  return gulp.src(['./css/src/*.less', '!./css/src/__*.less'])
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(autoprefixer({
      grid: true,
      cascade: false,
    }))
    .pipe(clean_css({
      level: {
        2: {
          overrideProperties: false,
          restructureRules: true,
        },
      },
    }))
    .pipe(sourcemaps.write('./')) // writes to an external .map file
    .pipe(gulp.dest('./css/dist/'))
})

gulp.task('build', ['test', 'docs', 'dist'])
