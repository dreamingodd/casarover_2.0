<template>
<div >
    <swiper :list="slide" :auto="true"></swiper>
    <!-- <slide></slide> -->
    <nav class="navbar">
        <ul>
          <li v-link="{ name: 'allcasa' }" style="background:#00CCFF">民宿大全</li>
          <li v-link="{ name: 'hotlists' }" style="background:#C391E2">民宿推荐</li>
          <li v-link="{ name: 'themes' }" style="background:#87DB83">精选主题</li>
          <li v-link="{ name: 'series' }" style="background:#6699FF">探庐系列</li>
        </ul>
    </nav>
    <h2>区域推荐</h2>
    <template v-for="banner in areas">
      <banner v-link="{ name:'area',params:{id:banner.id}}" :banner="banner"></banner>      
    </template>
</div>
</template>

<script>
import swiper from 'vux/src/components/swiper'

export default {
  data(){
    return {
      slide:[],
      areas:[]
    }
  },
  created:function(){
    this.getinfo();
  },
  methods:{
    getinfo:function () {
      this.$http.get('/m/home/').then((response) => {
        if (response.json().code === 0){
          this.$set('areas', response.json().result.areas);
          this.$set('slide', response.json().result.slides);
        } else {
          console.log(response);
        }
      })
    }
  },
  components: {
    'banner': require('../components/areaBanner.vue'),
    swiper
  }
}
</script>
<style lang="less" scoped>
  nav{
    overflow: hidden;
    margin-bottom: 1rem;
    ul{
      text-align: center;
      li{
        width: 48%;
        margin: .5rem 1%;
        height: 3rem;
        line-height: 3rem;
        float: left;
        list-style: none;
        font-size: 16px;
        color: #fff;
        cursor: pointer;
      }
    }
  }
  h2{
    text-align: center;
    color: #666;
  }
  .banner{
    margin: .5rem 0;
  }
</style>