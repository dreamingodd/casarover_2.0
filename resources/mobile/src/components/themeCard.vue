<template>
<!-- 精选主题 -->
<section>
    <!-- <h2>精选主题</h2> -->
    <div class="theme-card">
        <a >
            <div class="head-img">
                <img :src="theme.pic" width="100%" alt="">
            </div>
            <div class="message">
                <p>{{ theme.brief }}</p>
            </div>
        </a>
    </div>
</section>
</template>
<script>
    export default{
        props:['theme'],
    }
</script>
<style lang="less">
.theme-card{
  margin-top: 1rem;
  height: 144px;
  box-shadow: 0 1px 4px 0 rgba(0,0,0,0.14);
  width: 100%;
  overflow: hidden;
  .head-img{
    width: 50%;
    height: 150px;
    float: left;
    overflow: hidden;
    img{
      height: 150px;
      width: 200px;
    }
  }
  .message{
    width: 50%;
    float: left;
    p{
      padding: 1.5rem;
      height: 80px;
      word-break:break-all;
      overflow: hidden;
      display: block;
    }
  }
}
</style>