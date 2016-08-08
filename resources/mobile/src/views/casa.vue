<template>
    <div class="casa-main">
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
          this.$http.get('/m/casa/'+this.id).then((response) => {
            if (response.json().code === 0){
              this.$set('casa', response.json().result.casa);
            } else {
              console.log(response);
            }
          })
        }
    }
}
</script>
<style lang="less" scoped>
.casa-main{
  padding: 0 1rem;
  margin-bottom: 1rem;
  color: #777;
  img{
    width: 100%;
  }
}
h1{
  text-align: center;
  margin: 1rem 0;
}
article{
  h2{
    text-align: center;
    margin: .5rem 0;
  }
  p{
    margin: .5rem 0;
    padding: 0 5px;
    line-height: 22px;
    font-size: 14px;
    color: #777;
  }
}









.bottom{
  text-align: center;
  overflow: hidden;
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