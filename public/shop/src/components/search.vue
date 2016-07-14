<template>
        <form class="form-inline" >
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" v-model="query"  placeholder="卡号，手机号，用户名">
            </div>
          </div>
          <button type="button" class="btn btn-primary" @click="search">搜索</button>
        </form>
        <div class="clear"></div>
        
</template>
<script>
export default {
  data () {
    return {
      query: ''
    }
  },
  methods:{
      search:function(){
        this.$dispatch('child-msg', this.query);  
      }
  }
}
</script>
<style>
  .form-inline{
    margin: 10px 0;
    float: right;
    
  }
  .clear{
    clear: both;
  }
</style>