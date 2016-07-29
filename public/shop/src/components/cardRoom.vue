<template>
    <table class="table table-bordered">
        <tr>
            <td>房型</td>
            <td>总计</td>
            <td>已预约</td>
            <td>未使用</td>
        </tr>
        <template v-for="good in goods">
            <tr>
                    <td>{{ good.name }}</td>
                    <td>{{ good.quantity }}</td>
                    <td>{{ good.quantity-good.left }}</td>
                    <td>{{ good.left }}</td>                
            </tr>
        </template>
    </table>
</template>
<script>
    export default {
        props:['goods']
    }
</script>