import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
  vacation: {
    cards: {}
  },
  orders: {
    goods: [],
    total: null
  }
}

const mutations = {
  INCREMENT (state, amount) {
    state.vacation.casas = amount
  },
  ADDGOODS (state, goods) {
    goods.number ++
    state.orders.goods.push(goods)
  },
  REMOVEGOODS (state, goods) {
    // state.orders.goods[0].number = 20
    state.orders.goods.$set(goods, goods.number = 14)
    // state.orders.goods.$remove(goods)
  }
}

export default new Vuex.Store({
  state,
  mutations
})
