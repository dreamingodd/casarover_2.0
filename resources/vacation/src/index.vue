<template>
    <nav-head title="度假卡"></nav-head>
    <div class="tab">
      <ul>
        <li v-bind:class="{'active': type == 0}" @click="getinfo(0)">单选</li>
        <li v-bind:class="{'active': type == 1}" @click="getinfo(1)">包幢</li>
      </ul>
    </div>
    <template v-for="casa in casas">
      <card :casa="casa"></card>
    </template>
</template>
<script>
export default{
  data () {
    return {
      casas: null,
      type: 0
    }
  },
  ready: function () {
    this.$http.get('/wx/api/cardCasaList').then((response) => {
      console.log(response)
      this.$set('casas', response.json())
    })
  },
  methods: {
    getinfo (type) {
      console.log(type)
      this.type = type
    }
  },
  components: {
    'nav-head': require('./components/header'),
    'card': require('./components/casaCard')
  }
}
</script>
<style lang="less">
    body{
        background: #F7F7F7;
    }
    .tab{
      overflow: hidden;
      text-align: center;
      line-height: 2.4rem;
      font-size: 2rem;
      padding:.5rem 0;
      margin-bottom: .5rem;
      color: #999;
      background: #fff;
    }
    ul{
      display: box;
      display: -webkit-box;
      list-style: none;
      li{
        box-flex:1;
        -webkit-box-flex: 1;
        border-right: 1px solid #eee;
      }
    }
    .active{
      color: #ff8c00;
    }
</style>