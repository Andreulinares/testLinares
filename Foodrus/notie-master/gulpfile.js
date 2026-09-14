const Webpack = require('webpack')
const gulp = require('gulp')
const rename = require('gulp-rename')
const sass = require('gulp-sass')(require('sass'))

// Limpiar dist
gulp.task('clean', async () => {
  const { deleteAsync } = await import('del')
  await deleteAsync(['./dist'])
})

// Configuración de Webpack
const webpackConfig = minimize => ({
  mode: minimize ? 'production' : 'development',

  entry: './src/notie.js',

  output: {
    filename: minimize ? 'notie.min.js' : 'notie.js',
    library: 'notie',
    libraryTarget: 'umd'
  },

  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: ['babel-loader']
      }
    ]
  },

  optimization: {
    minimize
  }
})

// Ejecutar Webpack
function runWebpack(config) {
  return new Promise((resolve, reject) => {
    Webpack(config, (err, stats) => {
      if (err) {
        reject(err)
        return
      }

      if (stats.hasErrors()) {
        reject(new Error(stats.toString({
          colors: true
        })))
        return
      }

      console.log(stats.toString({
        colors: true,
        modules: false
      }))

      resolve()
    })
  })
}

// JavaScript
gulp.task('script', async () => {
  await runWebpack(webpackConfig(false))
  await runWebpack(webpackConfig(true))
})

// CSS
gulp.task('style', () => {
  return Promise.all([
    new Promise((resolve, reject) => {
      gulp.src('./src/notie.scss')
        .pipe(
          sass().on('error', function (error) {
            sass.logError.call(this, error)
            reject(error)
          })
        )
        .pipe(gulp.dest('./dist'))
        .on('end', resolve)
    }),

    new Promise((resolve, reject) => {
      gulp.src('./src/notie.scss')
        .pipe(
          sass({
            style: 'compressed'
          }).on('error', function (error) {
            sass.logError.call(this, error)
            reject(error)
          })
        )
        .pipe(rename('notie.min.css'))
        .pipe(gulp.dest('./dist'))
        .on('end', resolve)
    })
  ])
})

// Build completo
gulp.task(
  'build',
  gulp.series('clean', gulp.parallel('script', 'style'))
)

// Watch
gulp.task('watch', () => {
  gulp.watch('./src/notie.scss', gulp.series('style'))
  gulp.watch('./src/notie.js', gulp.series('script'))
})

// Default
gulp.task(
  'default',
  gulp.series('clean', gulp.parallel('script', 'style'), 'watch')
)