<template>
    <nav-head back='1' title="使用充值卡"></nav-head>
    <div class="verify">
        <div class="card-no">
            <span>卡号</span>
            <input type="number" pattern="[0-9]*" placeholder="请输入卡号">
        </div>
        <div class="pwd">
            <span>密码</span>
            <input type="password" placeholder="请输入密码">
        </div>
    </div>
    <div class="submit">
        <button>立即使用</button>
    </div>
</template>
<script>
    export default{
      components: {
        'nav-head': require('./components/header')
      }
    }
</script>
<style lang="less">
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