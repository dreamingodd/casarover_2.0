<template>
<div class='tanlu'>
  <div class="serie-banner">
    <img :src="serie.img" alt="serie.img">
    <div class="guide-mess">
      <h2>{{ serie.name }}</h2>
      <p>{{ serie.brief }}</p>
    </div>
  </div>
  <section  class="article_list" v-for="article in articles">
      <a href="{{ article.address }}" >
          <div class="left">
              <img :src="article.img"/>
          </div>
          <div class="right">
              <span class="title">{{ article.title }}</span>
              <br/>
              <span class="content">{{ article.brief }}</span>
          </div>
      </a>
  </section>
</div>
</template>
<script>
export default{
  data () {
    return{
      serie:{},
      articles:[]
    }
  },
  route: {
    data (tab) {
      this.getSerie(tab.to.params.id)
    }
  },
  methods: {
    getSerie (id) {
          this.$http.get('/m/serie/' + id).then((response) => {
            if (response.json().code === 0){
              this.$set('articles', response.json().result.articles);
              this.$set('serie', response.json().result.serie);
            } else {
              console.log(response);
            }
          })
        }
    }
}
</script>
<style lang="less" scoped>
.tanlu{
  width: 100%;
  height: 100%;
  overflow: hidden;
}
.serie-banner{
  position: relative;
  overflow: hidden;
  img{
    width: 100%;
  }
  .guide-mess{
    position: absolute;
    top: 30%;
    right: 0;
    color: #fff;
    h2{
      margin: 5px 0;
      text-align: center;
    }
    p{
      width: 90%;
      margin: 0 auto;
    }
  }
}

section{
  width:100%;
  height: 100%;
  margin: 1rem .5rem;
  overflow: hidden;
  border-bottom: 1px solid #E4E4E4;
  .left {
    float: left;
    width: 30%;
    img {
      padding-left: .5rem;
      width: 9rem;
      height: 6rem;
      float: left;
    }
  }
  .right {
    float: right;
    width: 70% ;
    .title {
      text-overflow: ellipsis;
    }
    .content {
      font-size: 10px;
      margin-top: 8px;
      color: #777777;
      display: -webkit-box;
      overflow: hidden;
      text-overflow: ellipsis;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
   }
}
</style>