## 部署

cd /var/www/html/casarover_2.0/
git pull

php artisan config:cache
php artisan route:cache
php artisan optimize --force


vue spa 开发流程
安装
npm install -g vue-cli
初始化
vue init webpack my-project
cd my-project
npm install
[参考文档](http://vuejs-templates.github.io/webpack/index.html)
PS: 推荐使用[cnpm](https://npm.taobao.org/) 替代，如果能Across them Great Wall，那就不用了
开发的时候
``` js
npm run dev
```
部署
``` js
npm run build
gulp move --name my-project
```

``` js
gulp move 作用
移动vue cli 打包的文件 gulp move --name 项目的名字，
index.html 会重名为文件夹的名字
```
