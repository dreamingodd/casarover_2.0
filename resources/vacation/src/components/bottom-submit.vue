<template>
    <div class="cover">
      <div class="bottom-submit ui-box">
          <div class="price">
              <span class="fa fa-credit-card"></span>
              <span>12345元</span>
          </div>
          <div class="btn">
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
  export default{
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
</style>