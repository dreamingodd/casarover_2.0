<template>
<div class="container">
    <!-- <slide></slide> -->
    <navbar></navbar>
    <template v-for="casa in casas">
      <recom-casa :casa="casa"></recom-casa>
    </template>
    <template v-for="theme in themes">
      <theme-card :theme="theme"></theme-card>      
    </template>
    <template v-for="serie in series">
      <series-card :serie="serie"></series-card>
    </template>
    
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
      $.getJSON('/m/home',(data) => {
        console.log(data);
        this.casas = data.result.casas;
        this.themes = data.result.themes;
        this.series = data.result.series;
      })
    }
  },
  components: {
    // slide:require('./components/slide'),
    navbar:require('./components/navbar'),
    recomCasa:require('./components/recomCasa'),
    themeCard:require('./components/themeCard'),
    seriesCard:require('./components/seriesCard'),
  }
}
</script>