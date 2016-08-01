<template>
    <div class="cover">
      <div class="bottom-submit ui-box">
          <div class="price">
              <span v-if="card" class="show fa fa-credit-card" transition="bounce"></span>
              <span v-else class="show fa fa-credit-card" transition="bounce"></span>
              <span>{{ totalPrice | roundDisplay }}元</span>
          </div>
          <div class="btn btn-disable">
              <a v-link="{ path:'/list',exact: true}">
                  <span>继续选</span>
              </a>
          </div>
          <div class="btn btn-submit">
            <a v-if="last == 1" @click="pay">
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
import { addGoods, clearOtherPay, resetOtherPay } from '../vuex/actions'

export default{
  data () {
    return {
      card: 1
    }
  },
  ready: function () {
    this.getGoodsFromLocal()
  },
  vuex: {
    getters: {
      diff (state) {
        return state.diff
      },
      listPrice (state) {
        let goodsPrice = 0
        for (const i in state.goods) {
          if (state.goods[i].number > 0) {
            goodsPrice += state.goods[i].price * state.goods[i].number
          }
        }
        return goodsPrice
      },
      list (state) {
        const trueGoods = []
        for (const i in state.goods) {
          if (state.goods[i].number > 0) {
            trueGoods.push(state.goods[i])
          }
        }
        return trueGoods
      },
      otherpay (state) {
        return state.otherpay
      },
      otherPayPrice (state) {
        let minus = 0
        for (const i in state.otherpay) {
          if (state.otherpay[i].isuse) {
            minus += state.otherpay[i].price
          }
        }
        return minus
      },
      user (state) {
        return state.user
      },
      dealer (state) {
        return state.dealer
      }
    },
    actions: {
      clearOtherPay,
      resetOtherPay,
      addGoods
    }
  },
  watch: {
    'totalPrice': function (val, old) {
      this.resetOtherPay()
      // console.log(this.list)
      // window.localStorage.setItem('goods', this.list)
    }
  },
  computed: {
    'totalPrice': function () {
      const result = this.listPrice - this.otherPayPrice
      console.log(result)
      if (result < 0 && Math.abs(result) > this.diff) {
        this.clearOtherPay()
        return this.listPrice
      } else {
        return result
      }
    }
  },
  methods: {
    getGoodsFromLocal () {
      // const k = window.localStorage.getItem('goods').split(',')
      // this.addGoods(k)
    },
    pay () {
      this.$http.post('/wx/api/cardCasaBuy',
        {
          casas: this.list,
          user: this.user,
          coupons: this.otherpay,
          dealer: this.dealer
        }).then((response) => {
          const result = response.json()
          console.log(result)
          if (result.orderId) {
            if (result.total === 0) {
              window.location.href = '/wx/order/detail/' + result.orderId
            } else {
              window.location.href = '/wx/pay/wxorder/' + result.orderId
            }
          } else {
            window.alert(result.msg)
          }
        })
    },
    checkNumber () {
      let num = 0
      for (const i in this.list) {
        num += this.list[i].number
      }
      if (num < 3) {
        return null
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