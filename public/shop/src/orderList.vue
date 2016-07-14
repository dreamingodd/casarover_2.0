<template>
    <search></search>
      <template v-for="order in orderList">
        <vacation-Card></vacation-Card>
        <order-Info :order="order"></order-Info>
      </template>
      <pagination :pages="pages" :page="page"></pagination>
</template>

<script>
import search from './components/search'
import vacationCard from './components/vacationCard'
import orderInfo from './components/orderInfo'
import pagination from './components/pagination'

export default {
  data(){
    return{
      orderList:null,
      type:null,
      pages:null,
      page:null,
      query:null
    }
  },
  created: function(){
    this.getOrderList();
  },
  route:{
    data(tab){
      this.type = tab.to.params.type || -1;
      this.page = tab.to.query.page || 1;
      this.query = null;
      this.getOrderList();
    }
  },
  methods: {
    getOrderList: function(){
        $.getJSON('/api/merch/orderList/'+this.type+'?page='+this.page+'&query='+this.query, (data)=> {
            if( data.code === 0){
              // console.log(data.result.last_page);
              this.pages = data.result.last_page;
              this.orderList = data.result.data;   
            }else{
              console.log(data);
              alert('出错了，请刷新重试');
            }
        });
    }
  },
  events: {
    'child-msg': function(query){
      this.query = query;
      this.getOrderList();
    }
  },
  components: {
    search,
    vacationCard,
    orderInfo,
    pagination
  }
}
</script>
