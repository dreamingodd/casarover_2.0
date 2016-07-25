<template>
    <div class="userinfo">
        <div class="name input-default">
            <span>联系人</span>
            <input type="text" placeholder="请填写真实姓名">
        </div>
        <div class="phone input-default">
            <span>电话</span>
            <input type="number" pattern="[0-9]*" placeholder="请填写有效的手机号">
        </div>
        <div class="address">
            <p>地址<span>(购买达一定金额会有精美礼品赠送)</span></p>
            <textarea name="" id="" cols="30" rows="5" placeholder="请填写真实地址，用于邮寄礼品"></textarea>
        </div>
    </div>
</template>
<style lang="less">
    .userinfo{
      padding: .5rem;
      .input-default{
        display: box;
        display: -webkit-box;
        background: #fff;
        font-size: 17px;
        line-height: 3.5rem;
        span{
            width: 6rem;
            display: block;
            padding-left: 1.5rem;
        }
        input{
            box-flex:1;
            -webkit-box-flex:1;
            width: 100%;
            border: 0;
            outline: 0;
            -webkit-appearance: none;
            background-color: transparent;
            font-size: inherit;
            color: inherit;
            height: 1.41176471em;
            line-height: 1.41176471;
        }
      }
      .name{
        border-bottom: 1px solid #eee;
      }
      .address{
        textarea{
            display: block;
            border: 0;
            resize: none;
            width: 100%;
            color: inherit;
            font-size: 1.5em;
            line-height: inherit;
            outline: 0;
        }
        p{
          padding-left: 1.5rem;
          font-size: 17px;
          line-height: .5rem;
          span{
            font-size: 12px;
          }
        }
      }
    }
</style>