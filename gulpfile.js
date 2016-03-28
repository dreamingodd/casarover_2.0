/**
*总计两个命令
*开发的时候gulp watch 
*部署的时候gulp produc
**/

// 适配laravel的工作流
// 本地开发环境下less js 等文件放在 resources/assets/ 下
// 通过watch 只要有改动就编译到 public/assets/ 对应的目录下 这里面是没有进行替换文件的

// 生产环境
// 对resources/assets 下的文件进行打包
// 上传到cdn服务器
// 对view下的页面文件进行静态文件的替换
var gulp = require('gulp'),
    less = require('gulp-less'),
    rev = require('gulp-rev'),
    revCollector = require('gulp-rev-collector'),
    jshint=require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    browserSync = require('browser-sync').create(),
    reload = browserSync.reload;
    const del = require('del');


// 通用

//语法检查
//gulp.task('jshint',function () {
//    return gulp.src('resources/assets/js/*.js')
//        .pipe(jshint())
//        .pipe(jshint.reporter('default'));
//});
// 压缩
gulp.task('uglify',function () {
    gulp.src('resources/assets/js/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('public/assets/js/'));
});

// 开发中使用


gulp.task('dev-less', function() {
    del.sync('public/assets/css/*.css');
    gulp.src(['resources/assets/less/main.less','resources/assets/less/back.less'])
        .pipe(less())
        .pipe(gulp.dest('public/assets/css/'))
});


// 部署执行
gulp.task('clean',function(){
    del.sync('public/assets/css/*.css');
    del.sync('public/assets/js/*.js');
});
// 编译less
gulp.task('less',['clean'],function() {
    gulp.src('resources/assets/less/main.less')
        .pipe(less())
        .pipe(rev())
        .pipe(gulp.dest('public/assets/css/'))
        .pipe(rev.manifest()) //生成rev-manifest.json文件
        .pipe(gulp.dest('resources/assets/rev'));
});
gulp.task('replace',['less'], function() {     //说明replace 是依赖于less任务 当less结束之后才会执行replace
    gulp.src(['resources/assets/rev/*.json', 'resources/views/*'])   //- 读取 rev-manifest.json 文件以及需要进行css名替换的文件
        .pipe(revCollector({
            replaceReved: true,
            dirReplacements: {
                // 'assets/js': function (manifest_value) {
                //     return '//7xp9p2.com1.z0.glb.clouddn.com/' + 'js/' + manifest_value;
                // }
                'assets/css': function (manifest_value) {
                    return 'assets/css/' + manifest_value;
                }
            }
        }))                                   //- 执行文件内css名的替换
        .pipe(gulp.dest('resources/views/'));                     //- 替换后的文件输出的目录
});


gulp.task('pro',['less','clean']);


gulp.task('watch', ['dev-less'],function() {

    browserSync.init({
        proxy: "http://localhost",
        port:"80"
    });

    gulp.watch('resources/assets/less/*.less',['dev-less']);
    gulp.watch('resources/assets/js/*js',['uglify']);
    gulp.watch('resources/**/**/*.*').on('change',reload);
});
