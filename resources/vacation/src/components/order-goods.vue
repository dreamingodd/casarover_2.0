<template>
    <div class="good" v-for="product in products">
        <div class="handle-good">
            <div class="tip">
                <p>{{ product.name }}</p>
                <p>￥{{ product.price }}</p>               
            </div>
            <div class="quantity">
            <span class="fa fa-minus" @click="minus"></span>
                <input type="text" value="1">
            <span class="fa fa-plus" @click="plus"></span>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
      methods: {
        plus () {
          console.log('plus')
        },
        minus () {
          console.log('minus')
        }
      },
      props: ['products']
    }
</script>
<style lang="less">
    .good{
        overflow: hidden;
        border-top: 1px solid #eee;
    }
    .handle-good{
        display: box;
        display: -webkit-box;
        .tip{
            box-flex:1;
            -webkit-box-flex:1;
            width: 100%;
            padding: .8rem 2rem;
            p{
              padding-left: 1.5rem;
              margin:0.5rem 0;
            }
        }
        .quantity{
            box-flex:1;
            -webkit-box-flex:1;
            width: 100%;
            font-size: 2rem;
            height: 2rem;
            line-height: 5rem;
            color: #868484;
            text-align: center;
            input{
                width: 15%;
                color: #232326;
                border: 1px solid #bdb6b6;
                padding: 0 .3rem;
                border-radius: 2px;
                outline: none;
                text-align: center;
                height: 100%;
                -webkit-appearance: none;
            }
        }
    }
</style>