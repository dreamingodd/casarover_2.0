import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './Home'
import Casa from './Casa'
import App from './App'


Vue.use(VueRouter);
var router = new VueRouter({
    linkActiveClass:'active',
})

// 定义路由规则
// 每条路由规则应该映射到一个组件。这里的“组件”可以是一个使用 Vue.extend
// 创建的组件构造函数，也可以是一个组件选项对象。
// 稍后我们会讲解嵌套路由
router.map({
    '/': {
        component: Home
    },
    '/casa/:id':{
        name: 'casa',
        component:Casa
    }
})
// router.redirect({
//     '/':"test"
// })



router.start(App, '#app');