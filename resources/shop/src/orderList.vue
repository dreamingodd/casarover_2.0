<template>
    <seltime :value="date"></seltime> 
    <search :query="query" :hold="hold"></search>
      <template v-for="order in orderList">
        <vacation-Card 
          :card_no="order.use_vacation_card.card_no"
          :username="order.use_vacation_card.username"
          :cellphone="order.use_vacation_card.cellphone"
          ></vacation-Card>
        <order-Info :order="order"></order-Info>
      </template>
      <pagination :pages="pages" :page="page"></pagination>
</template>
<script>
import search from './components/search'
import vacationCard from './components/vacationCard'
import orderInfo from './components/orderInfo'
import pagination from './components/pagination'
import seltime from './components/seltime'

export default {
  data(){
    return{
      orderList:null,
      type:null,
      pages:null,
      page:null,
      query:null,
      hold:'姓名/电话/订单号',
      date:''
    }
  },
  route:{
    data(tab){
      this.type = tab.to.params.type || -1;
      // 保证搜索的条件依然存在
      if(!tab.to.query.page){
        this.query = null;        
        this.date = '';
      }
      this.page = tab.to.query.page || 1;
      this.getOrderList();
    }
  },
  methods: {
    getOrderList: function(){
        $.getJSON('/api/merch/orderList/'+this.type+'?page='+this.page+'&query='+this.query+'&date='+this.date, (data)=> {
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
      this.query = query || null;
      this.page = 1;
      this.getOrderList();
    },
    'sel-date':function(date){
      this.date = date;
      this.getOrderList();
    }
  },
  components: {
    search,
    vacationCard,
    orderInfo,
    pagination,
    seltime
  }
}
</script>
