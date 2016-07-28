<template>
    <!-- 使用代金券等 -->
    <div class="use">
        <template v-if="paycards.length > 0">
          <button v-link="{ name:'verify'}">继续使用</button><i class="fa fa-angle-right"></i>        
        </template>
        <template v-else>
          <button v-link="{ name:'verify'}">使用充值卡</button><i class="fa fa-angle-right"></i>          
        </template>
    </div>
    <div class="chit" v-for="item in paycards">
        <div class="check">
            <input type="checkbox" v-model="item.isuse" >            
        </div>
        <div class="chit-info">
            <span>使用{{ item.name }}-{{ item.price }}</span>
        </div>
    </div>
</template>
<script>
import store from '../vuex/store'

export default{
  vuex: {
    getters: {
      paycards (state) {
        return state.otherpay
      }
    }
  },
  store
}
</script>
<style lang="less">
.use{
    height: 4rem;
    background: #fff;
    line-height: 4rem;
    font-size: 16px;
    padding-left: 2rem;
    button{
        border: 0;
        background: #fff;
        outline: none;
    }
}
.chit{
  display: box;
  display: -webkit-box;
  padding: 0 2rem;
  background: #fff;
  font-size: 16px;
  height: 3rem;
  line-height: 3rem;
  .check{
    margin-right: 1rem;
  }
  .chit-info{
    box-flex:1;
    -webkit-box-flex:1;
  }
  .use-more{
    box-flex:1;
    -webkit-box-flex:1;
  }
}
</style>