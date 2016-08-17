/**
 * 总计两个命令
 * 开发的时候gulp
 * 部署的时候gulp build
 * 移动vue cli 打包的文件 gulp move --name 项目的名字，
 * index.html 会重名为文件夹的名字
 * @author draguo
 **/


var gulp = require('gulp'),
    less = require('gulp-less'),
    rev = require('gulp-rev'),
    revCollector = require('gulp-rev-collector'),
    uglify = require('gulp-uglify'),
    browserSync = require('browser-sync').create(),
    reload = browserSync.reload,
    minifycss = require('gulp-minify-css');
    del = require('del');
    babel = require('gulp-babel');
    changed = require('gulp-changed');
    rename = require('gulp-rename');
    // debug = require('gulp-debug');

var lessDir = ['resources/assets/less/**/*.less'];
var reloadDir = ['resources/views/**/*.*'];

// 监视内容
gulp.watch(lessDir,['dev-less']);
gulp.watch('resources/assets/js/*.js',['js']);
gulp.watch('resources/assets/js/integration/*js',['uglify_integration']);
gulp.watch(reloadDir).on('change',reload);
gulp.task('default',function() {
    browserSync.init({
        proxy: "http://localhost",
        port:"80"
    });
});

//default
/**
* 编译less
* 使用gulp-changed时候 因为编译之后文件的类型改变了，必须进行单独的配置
**/
gulp.task('dev-less',function() {
    gulp.src('resources/assets/less/*.less')
        .pipe(changed('public/assets/css/',{extension:'.css'}))
        .pipe(less())
        .pipe(minifycss())
        .pipe(gulp.dest('public/assets/css/'))
        .pipe(reload({stream: true}));
});

/**
* 压缩js
* 检测changed设置的目录必须和dest的完全一致，
* 不要加 * 不然可能会不起作用
*/
gulp.task('js',function () {
    return gulp.src('resources/assets/js/*.js')
        .pipe(changed('public/assets/js/'))
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




// 部署执行 未完成
// 生产环境
// 对resources/assets 下的文件进行打包
// 上传到cdn服务器
// 对view下的页面文件进行静态文件的替换
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

// this is for vue webpack
gulp.task('move',['moveStatic'],function() {
    let project = gulp.env.name;
    gulp.src('resources/'+project+'/dist/index.html')
        .pipe(rename(project+'.blade.php'))
        .pipe(gulp.dest('resources/views/'));
});

gulp.task('moveStatic',function() {
    let project = gulp.env.name;
    gulp.src('resources/'+project+'/dist/static/**')
        .pipe(gulp.dest('public/static/'))
})

gulp.task('build',['replace','less','clean']);
