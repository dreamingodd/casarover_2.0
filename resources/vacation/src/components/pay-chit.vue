<template>
    <!-- 使用代金券等 -->
    <div class="use">
        <button v-link="{ name:'verify'}">使用充值卡</button><i class="fa fa-angle-right"></i>        
        <!-- <button>继续使用</button><i class="fa fa-angle-right"></i>         -->
    </div>
    <div class="chit">
        <div class="check">
            <input type="checkbox">            
        </div>
        <div class="chit-info">
            <span>使用1500度假卡-3000</span>
        </div>
<!--         <div class="use-more">
            <span>使用充值卡&nbsp;<i class="fa fa-angle-right"></i></span>
            <span>继续使用&nbsp;<i class="fa fa-angle-right"></i></span>
        </div> -->
    </div>
</template>
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