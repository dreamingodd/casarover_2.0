<template>
    <nav-head back='1' title="使用充值卡"></nav-head>
    <div class="verify">
        <div class="card-no">
            <span>卡号</span>
            <input type="text" v-model="number" placeholder="请输入卡号">
        </div>
        <div class="pwd">
            <span>密码</span>
            <input type="password" v-model="password" placeholder="请输入密码">
        </div>
    </div>
    <div class="submit" @click="check">
        <button >立即使用</button>
    </div>
</template>
<script>
import store from './vuex/store'
import { addOtherPay } from './vuex/actions'
export default{
  data () {
    return {
      number: null,
      password: null
    }
  },
  vuex: {
    actions: {
      addOtherPay
    }
  },
  methods: {
    check () {
      if (!this.number) {
        window.alert('卡号不能为空')
        return null
      }
      if (!this.password) {
        window.alert('密码不能为空')
        return null
      }
      // 发送ajax请求
      this.$http.post('/wx/api/checkCoupon',
        {
          number: this.number,
          password: this.password
        }).then((response) => {
          const data = response.json()
          if (data.code === 0) {
            this.addOtherPay(data.result)
            window.history.go(-1)
          } else {
            console.log(data)
            window.alert(data.msg)
          }
        })
    }
  },
  components: {
    'nav-head': require('./components/header')
  },
  store
}
</script>
<style lang="less">
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button{
        -webkit-appearance: none !important;
        margin: 0; 
    }
    .verify{
        padding-left: 2rem;
        font-size: 17px;
        line-height: 3.5rem;
        background: #fff;
        input{
            border: 0;
            outline: none;
            -webkit-appearance: none;
            background-color: transparent;
            font-size: inherit;
            color: inherit;
        }
        .card-no{
            border-bottom: 1px solid #eee;
        }
    }
    .submit{
        margin: .5rem 0;
        background: #fff;
        line-height: 3.5rem;
        font-size: 17px;
        text-align: center;
        button{
            border: 0;
            background: inherit;
            outline: none;
        }
    }
</style>