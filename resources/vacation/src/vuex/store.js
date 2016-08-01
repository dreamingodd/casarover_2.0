// 使用充值卡，显示金额，减去，验证
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
  type: 0,
  goods: [],
  user: {},
  otherpay: [],
  dealer: 0
}

const mutations = {
  USERINFO (state, info) {
    state.user = info
  },
  CHANGETYPE (state, type) {
    state.type = type
  },
  ADDGOODS (state, goods) {
    let hasOr = -1
    for (const i in state.goods) {
      if (goods.id === state.goods[i].id) {
        hasOr = i
      }
    }
    if (hasOr > -1) {
      goods.number = parseInt(state.goods[hasOr].number) + 1
      state.goods.$set(hasOr, goods)
    } else {
      Vue.set(goods, 'number', 1)
      state.goods.push(goods)
    }
  },
  GETFROMLOCAL (state, goods) {
    let hasOr = -1
    for (const i in state.goods) {
      if (goods.id === state.goods[i].id) {
        hasOr = i
      }
    }
    if (hasOr > -1) {
      goods.number = parseInt(state.goods[hasOr].number)
      state.goods.$set(hasOr, goods)
    }
  },
  REMOVEGOODS (state, goods) {
    // state.orders.goods[0].number = 20
    state.orders.goods.$set(goods, goods.number = 14)
    // state.orders.goods.$remove(goods)
  },
  ADDOTHERPAY (state, result) {
    let index = -1
    for (const i in state.otherpay) {
      if (result.id === state.otherpay[i].id) {
        index = i
      }
    }
    console.log(index)
    if (index > -1) {
      window.alert('请勿重复添加')
      return null
    } else {
      state.otherpay.push(result)
    }
  },
  CLEAROTHERPAY (state) {
    for (const i in state.otherpay) {
      state.otherpay[i].isuse = false
      state.otherpay.$set(i, state.otherpay[i])
    }
  },
  RESETOTHERPAY (state) {
    for (const i in state.otherpay) {
      state.otherpay[i].isuse = true
      state.otherpay.$set(i, state.otherpay[i])
    }
  },
  DELETEOTHERPAY (state, card) {
    state.otherpay.$remove(card)
    for (const i in state.otherpay) {
      state.otherpay[i].isuse = true
      state.otherpay.$set(i, state.otherpay[i])
    }
  },
  ADDDEALER (state, dealer) {
    state.dealer = dealer
  }
}

export default new Vuex.Store({
  state,
  mutations
})
