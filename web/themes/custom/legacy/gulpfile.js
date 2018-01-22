const kss          = require('kss')
const gulp         = require('gulp')
const pug          = require('gulp-pug')
const less         = require('gulp-less')
const autoprefixer = require('gulp-autoprefixer')
const clean_css    = require('gulp-clean-css')

gulp.task('pug:test', function () {
  return gulp.src(__dirname + '/proto/legacytest.pug')
    .pipe(pug({
      basedir: './',
      locals: {
      }
    }))
    .pipe(gulp.dest('./proto/'))
})

// HOW-TO: https://github.com/kss-node/kss-node/issues/161#issuecomment-222292620
gulp.task('docs:kss', function () {
  return kss(require('./kss.config.json'))
})

gulp.task('lessc:dev', function () {
  return gulp.src(__dirname + '/css/src/legacy.less')
    .pipe(less())
    .pipe(autoprefixer({
      grid: true,
      cascade: false,
    }))
    .pipe(gulp.dest('./css/'))
})

gulp.task('lessc:core', ['lessc:dev'], function () {
  return gulp.src([`${__dirname}/css/src/*.less`, `!${__dirname}/css/src/legacy.less`]) // ignore legacy.less
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
    .pipe(gulp.dest('./css/dist/'))
})

gulp.task('build', ['pug:test', 'lessc:core'])
