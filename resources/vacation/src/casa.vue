<template>
    <nav-head back="1" :title="casa.name"></nav-head>
    <div class="head-img">
      <img :src="casa.headImg" alt="">      
    </div>
    <h2>房型选择</h2>
    <product :products="casa.products" ></product>
    <content :contents="casa.contents"></content>
    <submit></submit>
</template>
<script>
export default{
  data () {
    return {
      casa: [],
      type: 0
    }
  },
  route: {
    data (tab) {
      this.type = tab.to.query.type
      this.getinfo(tab.to.params.id)
    }
  },
  methods: {
    getinfo (id) {
      this.$http.get('/wx/api/cardCasa/' + id + '?type=' + this.type).then((response) => {
        this.$set('casa', response.json())
      })
    }
  },
  components: {
    'nav-head': require('./components/header'),
    'content': require('./components/content'),
    'product': require('./components/product'),
    'submit': require('./components/bottom-submit')
  }
}
</script>
<style lang="less">
  .head-img{
    height: 20rem;
    overflow: hidden;
    img{
      width: 100%;
    }
  }
  hr{
    width: 98%;
    margin-bottom: 2rem;
  }
  h2{
    text-align: center;
    color: #666;
  }
</style>