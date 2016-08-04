<template>
<!-- 民宿推荐 -->
<section v-for="item in casas">
    <div class="cardcon">
        <a v-link="{ name:'casa', params:{ id:item.id }}" >
            <img :src="item.pic" width="100%">
            <div class="info">
                <div class="middle">
                    <h3>{{ item.name }}</h3>
                </div>
            </div>
        </a>
    </div>
</section>
</template>
<script>
export default{
  data () {
    return{
      casas:[]
    }
  },
  created () {
    this.$http.get('/m/hotlists').then((response) => {
      if (response.json().code === 0){
        this.$set('casas', response.json().result);
      } else {
        console.log(response);
      }
    })
  }
}
</script>
<style lang="less">
.cardcon{
    margin: 0 auto;
    background: #FFFFFF;
    box-shadow: 0 1px 4px 0 rgba(0,0,0,0.14);
    margin-bottom: 1rem;
    img{
        width: 100%;
    }
    h3{
        padding-left: 2rem;
        line-height: 3rem;
    }
}
</style>