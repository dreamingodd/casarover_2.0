import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import App from './App'
import routerMap from './routes'

Vue.use(VueRouter);
Vue.use(VueResource);
var router = new VueRouter({
    linkActiveClass:'active',
})

routerMap(router);

router.start(App, '#app');
