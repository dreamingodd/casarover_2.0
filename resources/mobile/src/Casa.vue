<template>
    <div class="main">
        <!-- 民宿大图  -->
        <div class="banner">
            <div class="show-mess">
                <h1>{{ casa.name }}</h1>
            </div>
        </div>
        </header>
        <div class="line"></div>
        <!-- 民宿介绍内容 -->
        <article class="casa-article">
            <div class="article-main">
                <template v-for="content in casa.details">
                    <h2>{{ content.name }}</h2>
                    <p>{{{ content.text }}}</p>
                    <template v-for="img in content.imgs">
                        <img :src="img.src" alt="">
                    </template>
                </template>
            </div>
        </article>

        <div class="casa-mess">
            <div class="tag-list">
                <a v-for="tag in casa.tags">{{ tag.name }}</a>
            </div>
        </div>
<!--         <div class="bottom">
            <h2>猜你喜欢</h2>
                <div class="m-casa-guess">
                    <a href="{{ $casa->id }}" class="slide-a">
                        <div class="head-img">
                            <img src="{{ config('config.photo_folder').$casa->attachment->filepath }}" width="100%" alt="casaheadimg">
                        </div>
                        <div class="title">
                            <p>
                                {{$casa->name }}
                            </p>
                        </div>
                    </a>
                </div>
        </div> -->
    </div>

</template>
<script>
    export default{
        data(){
            return{
                id:null,
                casa:''
            }
        },
        route:{
            data(tab){
              this.id = tab.to.params.id;
              this.getCasa();
            }
        },
        methods:{
            getCasa:function () {
              $.getJSON('/m/casa/'+this.id,(data) => {
                console.log(data);
                this.casa = data.result.casa;
              })
            }
        }
    }
</script>
<style lang="less">
.main{
  padding: 0 1rem;
  margin-bottom: 1rem;
  img{
    width: 100%;
  }
}
.bottom{
  text-align: center;
  overflow: hidden;
}
.slides{
  li{
    height: 18rem;
  }
}
.right{
  text-align: center;
}
.slide-mess{
  position: absolute;
  width: 16rem;
  left: 50%;
  margin-left: -8rem ;
  font-size: 2rem;
  text-shadow: 0px 1px 3px #000;
}
.show-mess{
  h1{
    color: #333333;
    text-align: center;
  }
}
.m-casa-guess{
  width: 50%;
  height: 90px;
  overflow: hidden;
  float: left;
  position: relative;
  img{
    height: 90px;
  }
  .title{
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    p{
      color: #FFFFFF;
      line-height: 90px;
    }
  }
}
.slide-a{
  padding: 3px;
}
</style>