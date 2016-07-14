<template>
      <search></search>
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
import search from './components/search'
import vacationCard from './components/vacationCard'
import cardRoom from './components/cardRoom'
import pagination from './components/pagination'


export default {
  data(){
    return{
      cardList:null,
      pages:null,
      page:null  
    }
  },
  created: function(){
    this.getOrderList();
  },
  route:{
    data(tab){
      this.page = tab.to.query.page || 1;
      this.query = null;
      this.getOrderList();
    }
  },
  methods: {
    getOrderList: function(){
        $.getJSON('/api/merch/cardList?page='+this.page+'&query='+this.query, (data)=> {
            if( data.code === 0){
              this.pages = data.result.last_page;
              this.cardList = data.result.data;              
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
    search,
    vacationCard,
    cardRoom,
    pagination
  }
}
</script>