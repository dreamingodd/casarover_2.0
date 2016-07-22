<template>
    <div class="product" v-for="product in products">
        <div class="product-info">
            <div class="name">
                <h3>{{ product.name }}</h3>
            </div>
            <div class="price">
                <p>￥{{ product.price }}</p>
            </div>
        </div>
        <div class="handle">
            <div class="tip">
                <span>数量</span>                
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
    .product{
        overflow: hidden;
        padding-bottom: .8rem;
        // background: #123;
        border-top: 1px solid #eee;
    }
    .product-info{
        .name{
            float: left;
            width: 50%;
            padding-left: 2rem;
            h3{
                color: #333;
                font-size: 1.5rem;
                line-height: 2rem;
            }
        }
        .price{
            text-align: right;
            padding-right: 1.8rem;
            font-size: 1.8rem;
            p{
                line-height: 2rem;
            }
        }
    }
    .handle{
        padding-left: 2.4rem;
        line-height: 3rem;
        .tip{
            width: 50%;
            float: left;
            
        }
        .quantity{
            width: 50%;
            float: left;
            text-align: center;
            font-size: 2rem;
            height: 2rem;
            color: #868484;
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