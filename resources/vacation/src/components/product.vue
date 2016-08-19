<template>
    <div class="product" v-for="product in products">
        <div class="product-info">
            <div class="name">
                <h3>{{ product.name }}</h3>
            </div>
            <div class="price">
                <p>￥{{ product.price }}&nbsp;<span>￥{{ product.orig }}</span></p>
            </div>
        </div>
        <div class="handle">
            <div class="tip">
                <span>数量</span>
            </div>
            <div class="quantity" v-if="product.surplus > 0">
                <span class="fa fa-minus" @click="minus($index)"></span><input type="text" v-model="product.number" placeholder="0" ><span class="fa fa-plus" @click="plus($index)"></span>
            </div>
            <div class="quantity" v-else>
                <span>已售罄</span>
            </div>
        </div>
    </div>
</template>
<script>
import store from '../vuex/store'
import { addGoods, getFromlocal } from '../vuex/actions'

export default{
  watch: {
    'products': function (val, old) {
      for (const i in this.products) {
        this.getFromlocal(this.products[i])
      }
    }
  },
  vuex: {
    actions: {
      addGoods,
      getFromlocal
    }
  },
  methods: {
    plus (index) {
      this.addGoods(this.products[index])
    },
    minus (index) {
    // 这样写是不符合规范的，但是真的是好用啊
      if (this.products[index].number) {
        this.products[index].number --
      }
    }
  },
  store,
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
                color: #777;
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
                span{
                  font-size: 1.5rem;
                  text-decoration: line-through;
                  color:#a1a1a1;
                }
            }
        }
    }
    .handle{
        padding-left: 2.4rem;
        line-height: 3rem;
        .tip{
            width: 50%;
            float: left;
            font-size: 14px;
        }
        .quantity{
            width: 50%;
            float: left;
            text-align: center;
            font-size: 2rem;
            height: 2.8rem;
            color: #868484;
            // border: 1px solid #eee;
            // background: #123;
            input{
                width: 10%;
                height: 3.2rem;
                line-height: 3.2rem;
                color: #232326;
                background: #F7F7F7;
                border: 0px solid #bdb6b6;
                border-top: 1px solid #eee;
                border-bottom: 1px solid #eee;
                padding: 0 .6rem;
                border-radius: 2px;
                outline: none;
                text-align: center;
                -webkit-appearance: none;
            }
            .fa{
                 display: inline-block;
                 background: #EFEEEC;
                 padding: 10px;
                 color: #A9A8A6;
            }
        }
    }
</style>
