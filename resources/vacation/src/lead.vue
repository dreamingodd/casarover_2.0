<template>
<div class="back-img">
  <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/lead2.jpg" alt="">  
</div>
  <div class="buy" v-link="{ path:'/list',exact: true}"></div>
  <div class="rule"></div>
  <div class="article"></div>
</template>
<script>
import store from './vuex/store'
import { addDealer } from './vuex/actions'

export default{
  vuex: {
    actions: {
      addDealer
    }
  },
  route: {
    data (tab) {
      const fromdealer = tab.to.query.dealer
      this.addDealer(fromdealer)
    }
  },
  store,
  components: {
    'nav-head': require('./components/header')
  }
}
</script>
<style lang="less">
    .back-img{
      height: 100%;
      width: 100%;
      position: absolute;
      overflow: hidden;
      img{
        width: 100%;
        height: 100%;
      }
    }
    .buy{
      width: 80px;
      height: 100px;
      position: fixed;
      left: 50%;
      margin-left: -40px;
      bottom: 4.5rem;
    }
    .rule{
      width: 100px;
      height: 100px;
      position: fixed;
      left: 1rem;
      bottom: 10.5rem;
    }
    .article{
      width: 100px;
      height: 100px;
      position: fixed;
      right: 1rem;
      bottom: 10.5rem;
    }

</style>