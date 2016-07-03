/**
 *总计两个命令
 *开发的时候gulp
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
    uglify = require('gulp-uglify'),
    browserSync = require('browser-sync').create(),
    reload = browserSync.reload,
    minifycss = require('gulp-minify-css');
const del = require('del');
const babel = require('gulp-babel');
const changed = require('gulp-changed');
// var debug = require('gulp-debug');

//配置部分
var lessDir = ['resources/assets/less/**/*.less'];
var jsDir = ['resources/assets/js/**/*.js'];
var reloadDir = ['resources/views/**/*.*'];

// 通用

//开发使用
// 编译less
gulp.task('dev-less',function() {
    //为了加快编译速度不进行删除操作，如果出现问题，重新添加回来
    gulp.src('resources/assets/less/*.less')
        .pipe(changed('public/assets/css/*'))
        .pipe(less())
        .pipe(minifycss())
        .pipe(gulp.dest('public/assets/css/'))
        .pipe(reload({stream: true}));
});
// 压缩js
gulp.task('js',function () {
    return gulp.src('resources/assets/js/*.js')
        .pipe(changed('public/assets/js/'))
        // .pipe(debug({title: 'unicorn:'}))
        .pipe(babel())
        .pipe(uglify())
        .pipe(gulp.dest('public/assets/js/'))
        .on("end",reload);
});

// 压缩js源码包
gulp.task('uglify_integration',function () {
    gulp.src('resources/assets/js/integration/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('public/assets/js/integration/'))
        .pipe(reload({stream: true}));
});




// 部署执行
gulp.task('clean',function(){
    del.sync('public/assets/css/*.css');
    del.sync('public/assets/js/*.js');
});
// 编译less
gulp.task('less',['clean'],function() {
    gulp.src('resources/assets/less/*.less')
        .pipe(less())
        .pipe(minifycss())
        .pipe(rev())
        .pipe(gulp.dest('public/assets/css/'))
        .pipe(rev.manifest()) //生成rev-manifest.json文件
        .pipe(gulp.dest('resources/assets/rev'));
});
gulp.task('replace',['less'], function() {     //说明replace 是依赖于less任务 当less结束之后才会执行replace
    gulp.src(['resources/assets/rev/*.json', 'resources/views/**/*.php'])   //- 读取 rev-manifest.json 文件以及需要进行css名替换的文件
        .pipe(revCollector({
            replaceReved: true,
            dirReplacements: {
                // 'assets/js': function (manifest_value) {
                //     return '//7xp9p2.com1.z0.glb.clouddn.com/' + 'js/' + manifest_value;
                // }
                '/assets/css': function (manifest_value) {
                    return '/assets/css/' + manifest_value;
                }
            }
        }))                                   //- 执行文件内css名的替换
        .pipe(gulp.dest('resources/views/'));                     //- 替换后的文件输出的目录
});

gulp.task('deploy',['replace','less','clean']);


gulp.task('default',function() {
    browserSync.init({
        proxy: "http://localhost",
        port:"80"
    });
    gulp.watch(lessDir,['dev-less']);
    gulp.watch('resources/assets/js/*.js',['js']);
    gulp.watch('resources/assets/js/integration/*js',['uglify_integration']);
    gulp.watch(reloadDir).on('change',reload);
});
