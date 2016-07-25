<template>
    <div class="order" v-for="x in 2">
      <div class="casa-info">
        <div class="casa-img">
          <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_20160721-112253-389r1648.png" alt="">
        </div>
        <div class="delete">
          <h3>福压机</h3>
          <span @click="del" class="fa fa-trash-o"></span>
        </div>
      </div>
        <div class="goods">
          <goods :products="products"></goods>          
        </div>
    </div>
</template>
<script>
    export default{
      data () {
        return {
          products: [{
            id: 132,
            name: '福雅集',
            parent_id: 7,
            price: 0.02
          }, {
            id: 132,
            name: '福雅集',
            parent_id: 7,
            price: 0.02
          }]
        }
      },
      methods: {
        del () {
          console.log('del')
        }
      },
      components: {
        'goods': require('./order-goods')
      }
    }
</script>
<style lang="less">
  .order{
    background: #fff;
  }
  .casa-info{
    display: box;
    display: -webkit-box;
    margin: .5rem 2rem;
    position: relative;
    .casa-img{
      height: 8rem;
      // width: 8rem;
      background: #123;
      img{
        height: 100%;
      }
    }
    .delete{
      -webkit-box-flex:1;
      box-flex:1;
      padding-left: 2rem;
      h3{
        font-size: 2rem;
        font-weight: normal;
      }
      span{
        font-size: 2rem;
        display: block;
        position: absolute;
        right: 0;
        bottom: 0;
      }
    }
  }

</style>