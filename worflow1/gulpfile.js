var gulp    = require('gulp'); // obtenemos gulp
var sass    = require('gulp-sass'); // modulo sass instalado
var browser = require('browser-sync').create();

gulp.task('server',['sass'], function(){
    browser.init({
      server: "./app"
    });

    gulp.watch("scss/**/*.scss", ['sass']); // observa los cambios en sass
    gulp.watch("app/*.html").on('change', browser.reload); // observa y recarga la pagina cuando hay cambios en el html
});


// configura la tarea sass para la compilacion
gulp.task('sass', function(){
  return gulp.src('scss/**/*.scss') // obtiene los documento de la fuente
          .pipe(sass()) // compilar con sass
          .pipe(gulp.dest('app/css')) // el resultado de compilar lo guarda alli
          .pipe(browser.stream()); // inyecta el resultado en el archivo html.
                                   // (solo usar cuando se esta usando browser-sync)
});
