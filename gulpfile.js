//var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
// 适配laravel的工作流
// 本地开发环境下less js 等文件放在 resources/assets/ 下
// 通过watch 只要有改动就编译到 public/assets/ 对应的目录下

// 生产环境
// 对resources/assets 下的文件进行打包
// 上传到cdn服务器
// 对view下的页面文件进行静态文件的替换
var gulp = require('gulp');
var less = require('gulp-less');
var rev = require('gulp-rev');
var revCollector = require('gulp-rev-collector');
const del = require('del');


// 编译less
gulp.task('less', ['clean'],function() {
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

gulp.task("clean",function () {
    del.sync('public/assets/css/*.css');
})

gulp.task('default',['less','clean','replace']);


