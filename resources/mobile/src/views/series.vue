<template>
<!-- 探庐系列 -->
<section v-for="item in series">
    <div class="cardcon" v-link="{ name:'serie', params:{ id:item.id }}">
        <img :src="item.pic" width="100%">
        <div class="info">
              <h3>{{ item.name }}</h3>
        </div>
    </div>
</section>
</template>
<script>
export default{
  data () {
    return{
      series:[]
    }
  },
  created () {
    this.$http.get('/m/series').then((response) => {
      if (response.json().code === 0){
        this.$set('series', response.json().result);
      } else {
        console.log(response);
      }
    })
  }
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