<template>
<div class="main-theme">
    <div class="article" v-clock>
        <h1>{{ theme.name }}</h1>
        <template v-for="article in articles">
            <article >
                <img :src="article.img" alt="article.img">
                <h2>{{ article.name }}</h2>
                <p>{{{ article.text }}}</p>
            </article>
        </template>
    </div>
    <div class="others">
        <h2>其他主题</h2>
        <template v-for="item in others">
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
<style lang="less" scoped>
  .main-theme{
    color: #666;
    padding: 0 1rem;
    margin-bottom: 1rem;
    img{
      width: 100%;
    }
    h1{
      text-align: center;
      margin: .5rem 0;
      display: block;
      padding-bottom: .5rem;
      border-bottom: 1px solid #aaa;
    }
  }
  article{
    h2{
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
  .others{
    margin: .5rem;
    a{
      display: block;
      font-size: 14px;
      line-height: 20px;
      border-bottom: 1px solid #aaa;
      padding: .5rem 0;
    }
  }
</style>
