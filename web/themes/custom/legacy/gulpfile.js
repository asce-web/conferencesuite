const path = require('path')

// require('@babel/core')         // DO NOT REMOVE … required by `gulp-babel`
// require('babel-preset-env')    // DO NOT REMOVE … required by babel preset configs
// require('babel-preset-minify') // DO NOT REMOVE … required by babel preset configs
const kss          = require('kss')
const gulp         = require('gulp')
const babel        = require('gulp-babel')
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
gulp.task('docs-kss-markup', async function () {
  return kss(require('./config/kss.json'))
})

gulp.task('docs-kss-style', async function () {
  return gulp.src('./docs/css/kss-custom.less')
  .pipe(less())
  .pipe(autoprefixer({
    grid: true,
  }))
  .pipe(gulp.dest('./docs/styleguide/'))
})

gulp.task('docs', ['docs-kss-markup', 'docs-kss-style'])

gulp.task('dist-style', async function () {
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

gulp.task('dist-script', async function () {
  return gulp.src('./js/src/*.js')
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ['env', 'minify']
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./js/dist/'))
})

gulp.task('dist', ['dist-style', 'dist-script'])

gulp.task('build', ['test', 'docs', 'dist'])
