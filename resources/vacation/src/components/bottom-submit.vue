<template>
    <div class="cover">
      <div class="bottom-submit ui-box">
          <div class="price">
              <span v-if="card" class="show fa fa-credit-card" transition="bounce"></span>
              <span v-else class="show fa fa-credit-card" transition="bounce"></span>
              <span>{{ totalPrice }}元</span>
          </div>
          <div class="btn btn-disable">
              <a v-link="{ path:'/',exact: true}">
                  <span>继续选</span>
              </a>
          </div>
          <div class="btn btn-submit">
            <a v-if="last == 1" v-link="{ name:'order' }">
              <span>立刻支付</span>
            </a>           
            <a v-else v-link="{ name:'order' }">
                <span>去结算</span>
            </a>
          </div>
      </div>
    </div>
</template>
<script>
import store from '../vuex/store'

export default{
  data () {
    return {
      card: 1
    }
  },
  vuex: {
    getters: {
      goods (state) {
        return state.orders.goods
      }
    }
  },
  computed: {
    'totalPrice': function () {
      let totalPrice = 0
      for (const i in this.goods) {
        totalPrice += this.goods[i].price * this.goods[i].number
      }
      return totalPrice
    }
  },
  methods: {
    putgood () {
      // this.card = 1
      // this.cad = 0
      const k = this.card
      if (k) {
        this.card = 0
      } else {
        this.card = 1
      }
    }
  },
  store,
  props: ['last']
}
</script>
<style lang="less">
.cover{
  position: relative;
  overflow: hidden;
  height: 5rem;
}
.ui-box{
  display: box;
  display: -webkit-box;
  box-pack: center;
  -webkit-box-pack: center;
  -webkit-box-align: center;
}
.bottom-submit{
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #fff;
  border-top: 1px solid #999;
  overflow: hidden;
  .price{
    -webkit-box-flex: 1;
    box-flex: 1;
    width: 100%;
    text-align: center;
    .show{
      font-size: 2.5rem;
    }
    span{
      font-size: 1.5rem;
    }
  }
  .btn{
    -webkit-box-flex: 1;
    box-flex: 1;
    width: 100%;
    text-align: center;
    height: 4.8rem;
    line-height: 4.8rem;
    a{
      display: block;
      height: inherit;
      font-size: 1.5rem;
    }
  }
  .btn-submit{
    background: #95d6da;
    a{
      color: #fff;
    }
  }
}

.bounce-transition {
  display: inline-block; /* 否则 scale 动画不起作用 */
}
.bounce-enter {
  animation: bounce-in .5s;
}
.bounce-leave {
  animation: bounce-out 0;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes bounce-out {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(0);
  }
}
.btn-disable{
  background: #F4F4F4;
}
</style>