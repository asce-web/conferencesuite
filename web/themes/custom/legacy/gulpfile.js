const path = require('path')

// require('@babel/core')         // DO NOT REMOVE … required by `gulp-babel`
// require('@babel/preset-env')   // DO NOT REMOVE … required by babel preset configs
// require('babel-preset-minify') // DO NOT REMOVE … required by babel preset configs
const kss          = require('kss')
const gulp         = require('gulp')
const babel        = require('gulp-babel')
const pug          = require('gulp-pug')
const less         = require('gulp-less')
const autoprefixer = require('gulp-autoprefixer')
const clean_css    = require('gulp-clean-css')
const sourcemaps   = require('gulp-sourcemaps')

function dist_style() {
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
}

function dist_script() {
  return gulp.src('./js/src/*.js')
    .pipe(sourcemaps.init())
    .pipe(babel({
			presets: [
				'@babel/preset-env',
				'minify',
			]
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./js/dist/'))
}

const dist = gulp.parallel(dist_style, dist_script)

function test() {
  return gulp.src(__dirname + '/proto/legacytest.pug')
    .pipe(pug({
      basedir: './',
      locals: {
      }
    }))
    .pipe(gulp.dest('./proto/'))
}

// HOW-TO: https://github.com/kss-node/kss-node/issues/161#issuecomment-222292620
async function docs_kss_markup() {
  return kss(require('./config/kss.json'))
}

function docs_kss_style() {
  return gulp.src('./docs/css/kss-custom.less')
  .pipe(less())
  .pipe(autoprefixer({
    grid: true,
  }))
  .pipe(gulp.dest('./docs/styleguide/'))
}

const docs = gulp.parallel(docs_kss_markup, docs_kss_style)

const build = gulp.parallel(dist, test, docs)

module.exports = {
	build,
		dist,
			dist_style,
			dist_script,
		test,
		docs,
			docs_kss_markup,
			docs_kss_style,
}
