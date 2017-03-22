var gulp        = require('gulp'); // obtenemos gulp
var sass        = require('gulp-sass'); // modulo sass instalado
var uglify      = require('gulp-uglify'); // minificacion de js
var cssnano     = require('gulp-cssnano'); // minificacion de css
var imagemin    = require('gulp-imagemin'); // modulo para optimizar imagen
var autoprefixer= require('gulp-autoprefixer'); // modulo para autoprefixer css
var htmlmin     = require('gulp-htmlmin'); // modulo para minificacon del html
var browser     = require('browser-sync').create(); //modulo de recarga de pagina
var pug         = require('gulp-pug')
//tarea principal que se lanzará
gulp.task('default',['css', 'javascript'], function(){
    browser.init({
      server: "./app"
    });

    gulp.watch("app/js/*.js", ['javascript']).on('change', browser.reload); // llamamos a la tarea de comprimir
    gulp.watch("scss/**/*.scss", ['css']); // observa los cambios en sass
    gulp.watch("./*.pug", ['pug']);
    gulp.watch("app/*.html").on('change', browser.reload); // observa y recarga la pagina cuando hay cambios en el html
    gulp.watch("./*.html", ['html']); // observa los cambios en los html
});

// tarea para el preprocesado de pug a html
gulp.task('pug', function(){
  gulp.src('./*.pug')
  .pipe(pug({
            pretty:true
            }))
  .pipe(gulp.dest("./"));
});

//  tarea para minificar los archivos html
gulp.task('html', function() {
  return gulp.src('./*.html')
    .pipe(htmlmin({collapseWhitespace: true}))
    .pipe(gulp.dest('app'));
});

// tarea para optimizar imagenes
// esta es una tarea independiente, no es necesario que este funcionando todo el tiempo.
// llamarlo cada vez que guardamos nuevas imagenes con
// # gulp optimizar
gulp.task('optimizarImagenes', function(){
        gulp.src('img/*')
        .pipe(imagemin())
        .pipe(gulp.dest('app/img'));
});

// tarea para la minificacion de los arhivos js.
gulp.task('javascript', function () {
        gulp.src("app/js/*.js")
          .pipe(uglify())
          .pipe(gulp.dest("app/js/dist"));
});

// configura la tarea sass para la compilacion
gulp.task('css', function(){
  return gulp.src('scss/**/*.scss') // obtiene los documento de la fuente
          .pipe(sass()) // compilar con sass
          .pipe(autoprefixer({ // autoprefixer para el css
              browsers: ['last 10 versions'],
              cascade: true
          }))
          .pipe(gulp.dest('app/css')) // el resultado de compilar lo guarda alli
          .pipe(cssnano()) // encargado de minificar el css
          .pipe(gulp.dest('app/css/dist')) // el resultado de compilar lo guarda alli
          .pipe(browser.stream()); // inyecta el resultado en el archivo html.
                                   // (solo usar cuando se esta usando browser-sync)
});
