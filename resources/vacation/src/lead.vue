<template>
<div class="back-img">
  <img src="/static/lead.png" alt="">  
</div>
<div class="link">
  <button class="buy">了解规则</button>
<!--   <button>原文链接</button>
  <button class="buy">立刻购买</button> -->
</div>
<!-- <div class="page">
    <h2>探庐度假卡</h2>
    <h3>规则介绍</h3>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <div class="go-button">
        <a class="go" v-link="{ path: '/list' }">立刻抢购</a>        
    </div>
</div> -->
</template>
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
      overflow: hidden;
      position: absolute;
      background: #123;
      img{
        width: 100%;
        height: 100%;
      }
    }
    .link{
      height: 13rem;
      width: 100%;
      z-index: 999;
      position: fixed;
      bottom: 0;
      right: 0;
      button{
        width: 15rem;
        margin: 0 auto;
        border-radius: 5px;
        background: #FFC701;
        color: #fff;
        padding: 1rem;
        font-size: 20px;
        display: block;
      }
      .buy{
        position: fixed;
        bottom: 4rem;
      }
    }
    .page{
      background: #fff;
      overflow: hidden;
      padding: 1rem;
    }
</style>