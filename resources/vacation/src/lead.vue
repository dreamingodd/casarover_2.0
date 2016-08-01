<template>
<div class="back-img">
  <img src="/static/lead2.jpg" alt="">  
</div>
  <div class="buy">立刻购买</div>

<!-- <div class="link">
  <button class="rule">了解规则</button>
  <button class="article">原文链接</button>
</div>
 --></template>
<script>
export default{
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
      height: 40px;
      background: #123;
      position: fixed;
      left: 50%;
      margin-left: -40px;
      bottom: 4.5rem;
    }
    .link{
      height: 23rem;
      width: 100%;
      z-index: 999;
      background: #123;
      position: relative;
      bottom: 0;
      right: 0;
      button{
        width: 150px;
        margin: 0 auto;
        border-radius: 5px;
        background: #FFC701;
        color: #fff;
        padding: 12px;
        font-size: 20px;
        display: block;
      }
      .buy{
        position: fixed;
        bottom: 60px;
        left: 50%;
        margin-left: -75px;
      }
    }
    .page{
      background: #fff;
      overflow: hidden;
      padding: 1rem;
    }
</style>