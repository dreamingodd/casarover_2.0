<template>
 <select-city v-if="selcity" :city="city" :area="area"></select-city>
 <div class="content" v-else>
    <banner v-link="{ name:'area',params:{id:area.id}}" v-show="banner.title" :banner="banner"></banner>
    <label @click="changecity">选择城市</label>
    <section id="casa-list">
        <template v-for="item in casas" block transition="expand">
            <div class="card" v-link="{ name:'casa', params:{ id:item.id }}">
                <img :src="item.pic" width="100%" >
                <h3>{{ item.name }}</h3>
                <p>标签：
                    <template v-for="tag in item.tags" v-cloak>
                        <template v-if="$index < 3">
                            <span class="tip">{{ tag.name }}</span>
                        </template>
                    </template>
                </p>
            </div>
        </template>

        <div v-if="!nextPage" class="no-more">
            没有更多了
        </div>
    </section>
</div> 

</template>
<script>
export default{
  data () {
    return{
      selcity: false,
      city:{'id':7,'value':'杭州'},
      casas:[],
      area:{'id':0},
      page:1,
      banner:{},
      scroll:true,
      nextPage:true
    }
  },
  created () {
    window.addEventListener('scroll', this.getScrollData)
    this.getCasas();
  },
  watch: {
    'city': function(){
      this.page = 1;
      this.casas = [];
    },
    'area': function(){
      this.page = 1;
      this.$set('casas',[]);
      this.nextPage = true;
      this.getCasas()
    }
  },
  methods: {
    getCasas () {
      this.scroll = false;
      this.$http.get('/m/casas/' + this.city.id + '/' + this.area.id + '?page=' + this.page).then((response) => {
        if (response.json().code === 0) {
            this.$set('casas', this.casas.concat(response.json().result.casas.data));
            if(response.json().result.banner){
              this.$set('banner',response.json().result.banner);              
            }else{
              this.$set('banner',{});
            }
            this.page ++;
            this.scroll = true;
            if (!response.json().result.casas.next_page_url) {
              this.nextPage = false;
            }
        } else {
          console.log(response)
        }
      })
    },
    getScrollData () {
      if ((window.document.body.scrollTop) + 740 > window.document.body.scrollHeight && this.scroll && this.nextPage) {
        this.getCasas();
      }
    },
    changecity () {
      this.selcity = true;
    }
  },
  components: {
    'selectCity': require('../components/selectCity.vue'),
    'banner': require('../components/areaBanner.vue')
  },
  events: {
    'set-area': function(city,area) {
      this.selcity = false;
      this.city = city;
      this.$set('area',area);
    }
  }
}
</script>
<style lang="less" scoped>
    .case {
      position: relative;
      height: 100%;
      width: 100%;
      overflow: hidden;
      .show{
        position: absolute;
        top: 6px;
        right: 0;
        padding-right: 60px;
      }
    }
    .screen{
      box-shadow: 5px 5px 10px #d6d6d6;
      padding-bottom: 20px;
      margin: 10px auto;
      background: #fff;
      padding-top: 30px;
    }
    .sel-key{
      float: left;
      width: 100px;
      padding-left: 48px;
      line-height: 34px;
    }
    .extend{
      height: auto;
    }
    .loader{
      text-align: center;
    }
    .main{
      width: 100%;
    }
    .city {
      display: none;
      background: #fff;
      padding: 1rem;
      .left{
        width: 50%;
        float: left;
      }
      .right{
        width: 50%;
        float: left;
        h3{
          float: right;
          margin-right: 1rem;
        }
      }
      h3{
        display: block
      }
      span {
        display: inline-block;
        font-size: 1.5rem;
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        border: 1px solid #ff8c00;
        margin: 1rem;
      }
      a {
        float: left;
        font-size: 1.5rem;
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        border: 1px solid #ff8c00;
        margin: 1rem;
      }
      .line{
        clear: both;
      }
    }
    .content {
      height: 100%;
      width: 96%;
      margin: 0 auto;
    }
    .content label {
      text-align: center;
      display: block;
      padding: 10px 0;
      width: 100%;
      height: 2rem;
      margin: 0.5rem auto 0 auto;
      cursor: pointer;
      text-transform: uppercase;
      font-size: 14px;
      border: .1rem solid #ced1d5;
      border-radius: .3rem;
      line-height: 2rem;
      color: #9ea3ab;
    }
    .area-list{
      margin-top: 2rem;
      text-align: center;
      a{
        font-size: 2rem;
        //border-radius: 4px;
        //border: 2px solid black;
        margin-right: 2rem;
      }
    }
    .card{
      width: 100%;
      padding-bottom: 10px;
      cursor: pointer ;
      margin: 1rem auto;
      background: #fff;
      box-shadow: 5px 5px 10px #d6d6d6;
    }
    .card h3{
      font-size: 1.5rem;
      line-height: 2.5rem;
      margin: 1rem 0 0 1.5rem;
    }
    .card p{
      font-size: 1rem;
      line-height: 2px;
      text-align: left;
      margin-left: 1.5rem;
    }
    .card .tip{
      border-radius: 5px;
      background: #ff8c00;
      color: #fff;
      padding: 2px 5px;
      font-size: 12px;
      margin: 0 5px 5px 0;
    }
    .no-more{
      text-align: center;
    }
    .banner{
      width: 98%;
      position: relative;
      margin:0 auto;
      .cover-photo{
        max-height: 250px;
      }
    }
    .banner .guide-mess{
      position: absolute;
      bottom: 0;
      left: 0;
      top: 50%;
      width: 100%;
      margin-top: -60px;
      z-index: 60;
      overflow: hidden;
      color: #fff;
      text-align: center;
      background: linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,0.3) 50%,rgba(0,0,0,0.8) 100%);
      h1{
        padding-bottom: 10px;
      }
      P{
        text-indent: 2em;
        margin: 0 auto;
        width: 80%;
        overflow: hidden;
        word-break: break-all;
        word-wrap: break-word;
        text-align: left;
      }
    }
</style>
