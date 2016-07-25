<template>
<!-- 探庐系列 -->
<section>
<!-- <h2>探庐系列</h2> -->
<!-- <div class="line"></div> -->
    <div class="cardcon">
        <a  >
            <img :src="serie.pic" width="100%">
            <div class="info">
                    <h3>{{ serie.name }}</h3>
            </div>
        </a>
    </div>
</section>
</template>
<script>
    export default{
        props:['serie'],
    }
</script>
<style lang="less">
    .cardcon{
  margin-bottom: 1rem;
  position: relative;
  img{
    height: 280px;
  }
  .info{
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    color: #fff;
    overflow: hidden;
    text-align: center;
    h3{
      line-height: 280px;
      height: 280px;
      font-size: 32px;
    }
  }
}
</style>