<template>
<div class="main-theme">
    <div class="article">
        <h1>{{ theme.name }}</h1>
        <template v-for="article in articles">
            <div class="case">
                <img :src="article.img" alt="article.img">
                <div class="articles">
                    <h2>{{ article.name }}</h2>
                    <p>{{{ article.text }}}</p>
                </div>
            </div>
        </template>
    </div>
    <div class="others">
        <h2>其他主题</h2>
        <template v-for="item in others">
            <div class="line"></div>
            <a v-link="{ name:'theme', params:{ id:item.id }}">
                <p>{{ item.name }}</p>
            </a>
        </template>
    </div>
</div>
</template>
<script>
export default{
  data () {
    return{
      theme:{},
      articles:[],
      others:[]
    }
  },
  route: {
    data (tab) {
      this.getTheme(tab.to.params.id)
    }
  },
  methods: {
    getTheme (id) {
          this.$http.get('/m/theme/' + id).then((response) => {
            if (response.json().code === 0){
              this.$set('theme', response.json().result.theme);
              this.$set('articles', response.json().result.contents);
              this.$set('others', response.json().result.others);
            } else {
              console.log(response);
            }
          })
        }
    }
}
</script>
<style lang="less">
  .main-theme{
    padding: 0 1rem;
    margin-bottom: 1rem;
    img{
      width: 100%;
    }
  }
  .slides{
    li{
      height: 18rem;
    }
  }
  .slide-a{
    text-align: center;
  }
  .right{
    h2{
      color: #333333;
      text-align: left;
      font-size: 1.5rem;
    }
    p{
      font-size: 1rem;
    }
  }
  .slide-mess{
    position: absolute;
    width: 16rem;
    left: 50%;
    margin-left: -8rem ;
    font-size: 2rem;
    text-shadow: 0 1px 3px #000;
  }
</style>
