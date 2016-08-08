<template>
<section v-for="item in themes">
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
<style lang="less" scoped>
.theme-card{
  margin: .8rem 0;
  height: 144px;
  box-shadow: 0 1px 4px 0 rgba(0,0,0,0.14);
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