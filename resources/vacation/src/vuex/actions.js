export const getCasas = function ({ dispatch, state }, casas) {
  dispatch('GETCASAS', casas)
}

export const addGoods = ({ dispatch, state }, goods) => { dispatch('ADDGOODS', goods) }
export const removeGoods = ({ dispatch, state }, goods) => { dispatch('REMOVEGOODS', goods) }
