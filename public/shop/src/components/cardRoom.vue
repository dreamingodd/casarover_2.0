<template>
    <table class="table table-bordered">
        <tr>
            <td>房型</td>
            <td>总计</td>
            <td>已预约</td>
            <td>未使用</td>
        </tr>
        <tr>
            <template v-for="good in goods">
                <td>{{ good.name }}</td>
                <td>{{ good.quantity }}</td>
                <td>{{ good.quantity-good.left }}</td>
                <td>{{ good.left }}</td>                
            </template>
        </tr>
    </table>
</template>
<script>
    export default {
        props:['goods']
    }
</script>