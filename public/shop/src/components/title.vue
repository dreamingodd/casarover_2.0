<template>
    <div class="van">
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
    }
</script>