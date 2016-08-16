## 第一次使用
因为前期使用的不是转换器，所以前面写的代码是没有符合规则
babel 默认是严格模式，对写法进行了很多的限制
``` js
'use strict'
```
为了去除这个东西  
在package.json文件中的devDependencies中加入  
``` js
"babel-plugin-transform-remove-strict-mode":"0.0.2"
```
然后在.babelrc 中配置
```js
{
  "presets": [
    "es2015"
  ] ,
  "plugins":[
    "transform-runtime",
    //下面这行
    "transform-remove-strict-mode"
  ]
}
```
[参考链接](https://github.com/shanggqm/blog/issues/1)

### 说明
这个是使用laravel进行后台开发的，所以大部分的东西是适应laravel的工作流的，至于为什么没有使用laravel自带的工具，主要是为了能够更好的进行自定义。
### 目录结构
less js 等文件放在 resources/assets/ 下
通过watch 只要有改动就编译到 public/assets/ 对应的目录下
### 模块介绍
// 对less文件进行编译  
gulp-less  
// 生成带有hash后缀的静态文件  
gulp-rev  
// 对静态文件的引用路径进行替换，和上面的搭配使用  
gulp-rev-collector  
// js压缩  
gulp-uglify  
// 浏览器自动刷新  
browser-sync  
// 压缩css  
gulp-minify-css  
// 删除指定目录或文件  
del  
// 对es6的转换  
gulp-babel  
// 只编译有修改的部分，加快编译速度，但是不能检测js第一次的编译  
gulp-changed  
// 调试使用  
gulp-debug  

### 代码部分
``` js
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
```
这样之后每次编译的时间能保持在1s内
