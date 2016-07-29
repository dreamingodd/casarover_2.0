<template>


    <div class="van">
        <nav class="navbar">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">
            探庐者
          </a>
        </div>
        <ul class="nav navbar-nav">
            <li ><a href="#">商家管理中心</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="">{{ casaname }}</a></li>
            <li><a href="">{{ username }}</a></li>
        </ul>
      </div>
    </nav>
        <ul class="nav nav-pills">
            <li v-link="{ path: '/card'}"><a href="">度假卡</a></li>
            <li v-link="{ path: '/order',exact: true}"><a href="">全部订单</a></li>
            <li v-link="{ name: 'order', params: { type: 0 }}"><a href="">未预约</a></li>
            <li v-link="{ name: 'order', params: { type: 1 }}"><a href="">已预约</a></li>
            <li v-link="{ name: 'order', params: { type: 3 }}"><a href="">已入住</a></li>
        </ul>
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        data () {
            return {
               username: null,
               casaname: null
            }
        },
        ready: function() {
            this.getInfo()
        },
        methods: {
            getInfo: function() {
               $.getJSON('/api/merch/user', (data)=> {
                   if( data.code === 0){
                    console.log(data);
                       this.username = data.result.username;
                       this.casaname = data.result.casaname;
                   }else{
                     console.log(data.msg);
                   }
               });
            }

        }
    }
</script>
<style>
    .navbar{
        background: #95d6da;
        color: #fff;
    }
    .navbar a{
        color: #fff;
    }
    .navbar-right{
        padding-right: 30px;
    }
</style>
