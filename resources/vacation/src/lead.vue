<template>
<nav-head></nav-head>
<div class="page">
    <h2>探庐度假卡</h2>
    <h3>规则介绍</h3>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <div class="go-button">
        <a class="go" v-link="{ path: '/list' }">立刻抢购</a>        
    </div>
</div>
</template>
<script>
export default{
  components: {
    'nav-head': require('./components/header')
  }
}
</script>
<style lang="less">
    .page{
      background: #fff;
      overflow: hidden;
      padding: 1rem;
    }
    .go-button{
      text-align: center;
     .go{
        width: 5rem;
        margin: 0 auto;
        border-radius: 5px;
        background: #ff8c00;
        color: #fff;
        padding: 1rem;
        display: block;
     }
    }
</style>