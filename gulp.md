## 第一次使用
因为前期使用的不是转换器，所以前面写的代码是没有符合规则
babel 默认是
``` js
严格模式，对写法进行了很多的限制
'use strict';
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
