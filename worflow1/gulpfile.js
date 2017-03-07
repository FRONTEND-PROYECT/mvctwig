var gulp    = require('gulp'); // obtenemos gulp
var sass    = require('gulp-sass'); // modulo sass instalado
var browser = require('browser-sync').create(); //modulo de recarga de pagina
var uglify = require('gulp-uglify'); // minificacion de js
var pump = require('pump'); // modulo auxiliar para la minificacion de js
var cssnano = require('gulp-cssnano'); // minificacion de css
var imagemin = require('gulp-imagemin');

//tarea principal que se lanzará
gulp.task('server',['sass'], function(){
    browser.init({
      server: "./app"
    });

    gulp.watch("scss/**/*.scss", ['sass']); // observa los cambios en sass
    gulp.watch("app/*.html").on('change', browser.reload); // observa y recarga la pagina cuando hay cambios en el html
    gulp.watch("app/js/*.js", ['comprimir']); // llamamos a la tarea de comprimir
});

// tarea para optimizar imagenes
// esta es una tarea independiente, no es necesario que este funcionando todo el tiempo.
// llamarlo cada vez que guardamos nuevas imagenes con
// # gulp optimizar
gulp.task('optimizar', () =>
        gulp.src('img/*')
        .pipe(imagemin())
        .pipe(gulp.dest('app/img'))
);

// tarea para la minificacion de los arhivos js.
gulp.task('comprimir', function (cb) {
  pump([
        gulp.src('app/js/*.js'),
        uglify(),
        gulp.dest('app/js/dist')
    ],
    cb
  );
});

// configura la tarea sass para la compilacion
gulp.task('sass', function(){
  return gulp.src('scss/**/*.scss') // obtiene los documento de la fuente
          .pipe(sass()) // compilar con sass
          .pipe(gulp.dest('app/css')) // el resultado de compilar lo guarda alli
          .pipe(cssnano()) // encargado de minificar el css
          .pipe(gulp.dest('app/css/dist')) // el resultado de compilar lo guarda alli
          .pipe(browser.stream()); // inyecta el resultado en el archivo html.
                                   // (solo usar cuando se esta usando browser-sync)
});
