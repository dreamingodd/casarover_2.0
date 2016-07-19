<template>
      <search :hold="hold"></search>
      <total :list="products"></total>
      <template v-for="card in cardList">
        <vacation-Card 
            :card_no="card.card_no"
            :username="card.username"
            :cellphone="card.cellphone">
        </vacation-Card>
        <card-room :goods="card.goods"></card-room>
      </template>
      <pagination :pages="pages" :page="page"></pagination>
</template>
<script>
import total from './components/total'
import search from './components/search'
import vacationCard from './components/vacationCard'
import cardRoom from './components/cardRoom'
import pagination from './components/pagination'


export default {
  data(){
    return{
      cardList:null,
      pages:null,
      page:null,
      hold:'卡号/姓名/电话',
      products:null
    }
  },
  route:{
    data(tab){
      if(!tab.to.query.page){
        this.query = null;        
      }
      this.page = tab.to.query.page || 1;
      this.getOrderList();
    }
  },
  methods: {
    getOrderList: function(){
        $.getJSON('/api/merch/cardList?page='+this.page+'&query='+this.query, (data)=> {
            if( data.code === 0){
              this.pages = data.result.cards.last_page;
              this.cardList = data.result.cards.data;
              this.products = data.result.products;
            }else{
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
    total,
    search,
    vacationCard,
    cardRoom,
    pagination
  }
}
</script>