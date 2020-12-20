const GulpClient = require("gulp");

const gulp = require("gulp");
const gulp_notify = require("gulp-notify");
const gulp_uglify = require("gulp-uglify-es").default;
const gulp_clean_css = require("gulp-clean-css");
const gulp_concat = require("gulp-concat");
const gulp_babel=require("gulp-babel");

gulp.task("minify-css", function () {
    return gulp.src([
            'assets/css/*.css',
        ])
        .pipe(gulp_clean_css())
        .pipe(gulp_concat("style.min.css"))
        .pipe(gulp.dest("dist/css"));
});

gulp.task("minify-vue", function () {
    return gulp.src([
            // 'assets/js/helpers/*.js',
            'assets/js/scripts/*.js',
            'assets/js/components/*.js',
            'assets/js/custom.js',
            'assets/js/app.js'
        ])
        .pipe(gulp_uglify())
        .pipe(gulp_concat("app.min.js"))
        .pipe(gulp.dest("dist/js"));
});