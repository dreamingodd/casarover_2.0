export default function (router) {
    router.map({
      '/': {            // 首页
        name: 'home',
        component: (resolve) => {
            require(['./views/index.vue'],resolve)
        }
      },
      'hotlists': {     // 推荐
        name: 'hotlists',
        component: require('./views/hotlists.vue')
      },
      'themes': {       // 主题
        name: 'themes',
        component: require('./views/themes.vue')
      },
      'series': {
        name: 'series',
        component: require('./views/series.vue')
      },
      'allcasa': {
        name: 'allcasa',
        component: require('./views/allcasa.vue')
      },
      '/casa/:id': {
        name: 'casa',
        component: require('./views/casa.vue')
      },
      '/area/:id': {
        name: 'area',
        component: require('./views/area.vue')
      },
      '/theme/:id': {
        name: 'theme',
        component: require('./views/theme.vue')
      },
      '/series/:id': {
        name: 'serie',
        component: require('./views/serie.vue')
      },
      '/about': {
        name: 'about',
        component: require('./views/about.vue')
      }
    })
}