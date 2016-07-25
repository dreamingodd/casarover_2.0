<template>
          <!-- logo -->
    <div  class="navbartop">
        <a href="/"><img  src="/static/logow.png" /></a>
    </div>
        <router-view></router-view>
    <footer clear>
    <div class="about">
        <ul>
            <li><a href="/mobile/about#contact">用户反馈</a></li>
            <li><a href="/mobile/about#about-us">关于我们</a></li>
        </ul>
    </div>
    <p>浙ICP备15036536号</p>
</footer>
</template>
<style lang="less">
.navbartop{
  height: 5rem;
  width: 100%;
  background: #ff8c00;;
  text-align: center;
  img {
    height: 60%;
    margin-top: 1rem  ;
  }
}
footer{
  clear: both;
  background: #333333;
  height: 100%;
  width: 100%;
  overflow: hidden;
  color: #fff;
  padding-top: 1rem;
  .about{
    height: 100%;
    width: 100%;
    overflow: hidden;
    text-align: center;
    li{
      width: 50%;
      display: inline-block;
      float: left;
      a{
        color: #FFFFFF;
        font-size: 1.2rem;
      }
    }
  }
  p{
    display: block;
    text-align: center;
  }
}
</style>