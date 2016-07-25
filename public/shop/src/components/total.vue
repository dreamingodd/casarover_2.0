<template>
    <p>销售总计</p>
    <table class="table table-bordered">
        <tr>
            <td>房型</td>
            <td>销量</td>
            <td>已使用</td>
            <td>未使用</td>
        </tr>
        <tr>
            <template v-for="good in list">
                <td>{{ good.name }}</td>
                <td>{{ good.sales }}</td>
                <td>{{ good.sales-good.surplus }}</td>
                <td>{{ good.surplus }}</td>                
            </template>
        </tr>
    </table>
</template>
<script>
    export default {
        created:function(){

        },
        props:['list'],
    }
</script>
<style>
    p{
        text-align: center;
    }
</style>