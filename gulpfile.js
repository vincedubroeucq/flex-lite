'use strict';

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    lec          = require ( 'gulp-line-ending-corrector' ),
    del = require('del');


// Compile Sass into expanded CSS
gulp.task('compileSass', function () {
    return gulp.src('./sass/style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(lec({eolc: 'CRLF'}))
        .pipe(gulp.dest('./'));
});


// Auto-prefix CSS.
gulp.task('prefixCSS', ['compileSass'], function () {
    return gulp.src('./style.css')
        .pipe(autoprefixer({
            browsers: ['last 3 versions'],
            cascade: false
        }))        
        .pipe(gulp.dest('./'));
});


// Task to clean old CSS files and theme folder.
gulp.task('clean', function(){
    return del(['style.css', 'flex-lite']);
});


// Build task. Build the theme for production
gulp.task('build', ['prefixCSS'], function(){
    return gulp.src([
                'fonts/**',
                'inc/**',
                'js/**',
                'languages/**',
                'page-templates/**',
                'template-parts/**',
                '*.php',
                'readme.txt',
                'screenshot.png',
                'style.css',
           ], {base: './'})
           .pipe(gulp.dest('./flex-lite'));
});

// Archive task. Build the theme for archiving
gulp.task('archive', ['prefixCSS'], function(){
    return gulp.src([
                'fonts/**',
                'inc/**',
                'js/**',
                'languages/**',
                'page-templates/**',
                'sass/**',
                'template-parts/**',
                '*.php',
                'gulpfile.js',
                'package.json',
                'readme.txt',
                'screenshot.png',
                'style.css'
           ], {base: './'})
           .pipe(gulp.dest('./flex-lite-archive'));
});

// Default task
gulp.task('default', ['clean'], function(){
    gulp.start('build');
})