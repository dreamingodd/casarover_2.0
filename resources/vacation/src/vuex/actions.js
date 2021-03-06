export const getCasas = function ({ dispatch, state }, casas) {
  dispatch('GETCASAS', casas)
}

export const addGoods = ({ dispatch, state }, goods) => { dispatch('ADDGOODS', goods) }
export const getFromlocal = ({ dispatch, state }, goods) => { dispatch('GETFROMLOCAL', goods) }
export const changeType = ({ dispatch, state }, type) => { dispatch('CHANGETYPE', type) }
export const userinfo = ({ dispatch, state }, info) => { dispatch('USERINFO', info) }
export const addOtherPay = ({ dispatch, state }, result) => { dispatch('ADDOTHERPAY', result) }
export const clearOtherPay = ({ dispatch, state }) => { dispatch('CLEAROTHERPAY') }
export const resetOtherPay = ({ dispatch, state }) => { dispatch('RESETOTHERPAY') }
export const deleteOtherPay = ({ dispatch, state }, cards) => { dispatch('DELETEOTHERPAY', cards) }
export const addDealer = ({ dispatch, state }, dealer) => { dispatch('ADDDEALER', dealer) }
