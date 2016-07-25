import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

import index from './index'
import casa from './casa'
import order from './order'
import verify from './verify'

Vue.use(VueRouter)
Vue.use(VueResource)
var router = new VueRouter({
  linkActiveClass: 'active'
})

// 定义路由规则
// 每条路由规则应该映射到一个组件。这里的“组件”可以是一个使用 Vue.extend
// 创建的组件构造函数，也可以是一个组件选项对象。
// 稍后我们会讲解嵌套路由
router.map({
  '/': {
    component: index
  },
  '/casa/:id': {
    name: 'casa',
    component: casa
  },
  '/order': {
    name: 'order',
    component: order
  },
  '/verify': {
    name: 'verify',
    component: verify
  }
})
// router.redirect({
//     '/':"test"
// })

const App = Vue.extend({})

router.start(App, '#app')
