<template>
    <div class="order" v-for="item in list">
      <template v-if="item.number > 0">
        <div class="casa-info">
          <div class="casa-img">
            <img :src="item.headImg" alt="">
          </div>
          <div class="good-info">
            <h3>{{ item.name }}</h3>
            <p>￥{{ item.price }}</p>
            <div class="quantity">
              <span class="fa fa-minus" @click="minus($index)"></span><input type="text" v-model="item.number"><span class="fa fa-plus" @click="plus($index)"></span>
            </div>
            <span @click="del($index)" class="delete fa fa-trash-o"></span>
          </div>
        </div>
      </template>
    </div>
</template>
<script>
import store from '../vuex/store'

export default{
  vuex: {
    getters: {
      list (state) {
        return state.goods
      }
    }
  },
  methods: {
    plus (index) {
      this.list[index].number ++
    },
    minus (index) {
      if (this.list[index].number > 1) {
        this.list[index].number --
      }
    },
    del (index) {
      this.list[index].number = 0
    }
  },
  components: {
    'goods': require('./order-goods')
  },
  store
}
</script>
<style lang="less">
  .order{
    background: #fff;
  }
  .casa-info{
    display: box;
    display: -webkit-box;
    margin: .5rem 1rem;
    position: relative;
    .casa-img{
      height: 8rem;
      width: 12rem;
      img{
        height: 100%;
        width: 100%;
      }
    }
    .good-info{
      -webkit-box-flex:1;
      box-flex:1;
      padding-left: 2rem;
      h3{
        font-size: 1.5rem;
        font-weight: normal;
      }
      p{
        margin: 0.5rem 0;
      }
      .delete{
          font-size: 2rem;
          display: block;
          position: absolute;
          right: .5rem;
          bottom: 0.5rem;
      }
    }
  }
  .quantity{
     display: block;
     margin-bottom: 1rem;
      width: 100%;
      font-size: 2rem;
      height: 2rem;
      color: #868484;
      input{
          width: 15%;
          height: 2.8rem;
          line-height: 2.8rem;
          color: #232326;
          background: #F7F7F7;
          border: 0px solid #bdb6b6;
          border-top: 1px solid #eee;
          border-bottom: 1px solid #eee;
          padding: 0 .6rem;
          border-radius: 2px;
          outline: none;
          text-align: center;
          -webkit-appearance: none;
      }
      .fa{
           display: inline-block;
           background: #EFEEEC;
           padding: 8px;
           color: #A9A8A6;
      }
  }

</style>
