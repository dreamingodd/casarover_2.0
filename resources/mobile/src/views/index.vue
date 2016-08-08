<template>
<div >
    <!-- <slide></slide> -->
    <nav class="navbar">
        <ul>
          <li v-link="{ name: 'allcasa' }" style="background:#00CCFF">民宿大全</li>
          <li v-link="{ name: 'hotlists' }" style="background:#C391E2">民宿推荐</li>
          <li v-link="{ name: 'themes' }" style="background:#87DB83">精选主题</li>
          <li v-link="{ name: 'series' }" style="background:#6699FF">探庐系列</li>
        </ul>
    </nav> 
</div>
</template>

<script>
export default {
  data(){
    return {
      casas:null,
      themes:null,
      series:null
    }
  },
  route:{
    data(){
      this.getinfo();      
    }
  },
  created:function(){
  },
  methods:{
    getinfo:function () {

    }
  },
  components: {
    // slide:require('./components/slide'),
    recomCasa:require('../components/recomCasa'),
    themeCard:require('../components/themeCard'),
  }
}
</script>
<style lang="less">
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
</style>