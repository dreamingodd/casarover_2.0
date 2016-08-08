<template>
    <link rel="stylesheet" href="/assets/css/mobileArea.css">
            <!-- 民宿大图  -->
    <div class="banner">
        <div class="cover-photo">
                <img :src="" width="100%" alt="">
        </div>
        <div class="guide-mess">
            <h1></h1>
            <p></p>
        </div>

    </div>
    <div class="container">
        <!-- 文字介绍 -->
        <section>
            <div class="article-main">
                <p></p>
            </div>
        </section>
        <div class="line"></div>
        {{--地图显示位置--}}
        <div id="mapContainer">
            <img src="http://restapi.amap.com/v3/staticmap?location={{  }}&zoom=14&size=450*300&markers=mid,,A:{{  }}&key=2886eb6e218fcd008bbdb478c16756dc" alt="">
        </div>
        <!-- 附近景点 -->
        <section>
        <div class="article-nav">附近景点</div>
        <div class="place-list">
          <div class="place-item" v-for="x in 2">
            <div class="place-img">
              <img src="" wdith="100%;" alt="">
            </div>
              <div class="place-mess">
                  <p></p>
              </div>
          </div>
        </div>
        </section>
        <div class="line"></div>
        <!-- 附近民宿 -->
        <section>
            <div class="article-nav">附近民宿</div>
            <div class="near-casa">
                <div class="casa-card" v-for="x in 2">
                    <div class="card-b">
                        <a href="/mobile/casa/{{ $casa->id }}" target="_blank">
                            <img src="" height="100%">
                            <div class="card">
                                <h3>{{ $casa->name }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default{
    data(){
        return{
          banner: {}
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
              this.$set('banner', response.json().result.banner);
            } else {
              console.log(response);
            }
          })
        }
    }
}
</script>
<style>
  
</style>