<template>
    <banner :banner="banner"></banner>
    <div class="container">
        <!-- 文字介绍 -->
        <section class="guide">
            <p>{{ area.guides }}</p>
        </section>
        <div id="mapContainer">
            <img :src="area.map" width="100%" >
        </div>
        <!-- 附近景点 -->
        <section>
            <div class="article-nav">附近景点</div>
            <div class="place-list">
              <div class="place-item" v-for="item in area.spots">
                <div class="place-img">
                  <img :src="item.pic" wdith="100%;">
                </div>
                  <div class="place-mess">
                      <p>{{ item.text }}</p>
                  </div>
              </div>
            </div>
        </section>
        <!-- 附近民宿 -->
        <div class="article-nav">附近民宿</div>
        <div class="near-casa">
          <div class="casa-card" v-for="item in area.casa">
            <div class="card-b" v-link="{ name:'casa', params:{ id:item.id }}">
              <img :src="item.pic">
              <div class="card">
                  <h2>{{ item.name }}</h2>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return{
          banner:{},
          area: {}
        }
    },
    route:{
        data(tab){
          const id = tab.to.params.id;
          this.getArea(id);
        }
    },
    methods:{
        getArea (id) {
          this.$http.get('/m/area/' + id).then((response) => {
            if (response.json().code === 0){
              this.$set('area', response.json().result);
              this.$set('banner.img', response.json().result.headImg);
              this.$set('banner.title', response.json().result.value);
              this.$set('banner.brief', response.json().result.brief);
            } else {
              console.log(response);
            }
          })
        }
    },
    components: {
      'banner': require('../components/areaBanner')
    }
}
</script>
<style lang="less">
.guide{
  p{
    margin: 1rem 1rem;
    padding: 0 5px;
    line-height: 22px;
    font-size: 14px;
    color: #777;
  }
}
#mapContainer {
  width: 100%;
  img{
    width: 100%;
  }
}
.article-nav{
  background: #FF9D00;
  line-height: 50px;
  font-size: 1.8rem;
  width: 100%;
  text-align: center;
  color: #fff;
}

.place-item{
  width: 100%;
  margin-top: 1rem;
  overflow: hidden;
  background: #fff;
  border-bottom: 1px solid #d6d6d6;
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.05);
  border-radius: 1px;
}
.place-mess{
  p{
    margin: 1rem 1rem;
    padding: 0 5px;
    line-height: 22px;
    font-size: 14px;
    color: #777;
    font-size: 14px;
  }
}

.card-b{
  margin: 1rem;
  img{
    width: 100%;
    display: block;
  }
  .card{
    border: 1px solid #999;
    border-top: 0;
    overflow: hidden;
    h2{
      color: #666;
    }
   } 
}
</style>