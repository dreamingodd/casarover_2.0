<template>
<!-- 精选主题 -->
<section v-for="item in themes">
    <!-- <h2>精选主题</h2> -->
    <div class="theme-card" v-link="{ name:'theme', params:{ id:item.id }}">
      <div class="head-img">
          <img :src="item.pic" width="100%" alt="">
      </div>
      <div class="message">
          <p>{{ item.brief }}</p>
      </div>
    </div>
</section>

</template>
<script>
export default{
  data () {
    return{
      themes:[]
    }
  },
  created () {
    this.$http.get('/m/themes').then((response) => {
      if (response.json().code === 0){
        this.$set('themes', response.json().result);
      } else {
        console.log(response);
      }
    })
  }
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