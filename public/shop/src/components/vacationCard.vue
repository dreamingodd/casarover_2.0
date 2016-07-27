<template>
    <div class="card-message">
        <div class="number">
            度假卡号：{{ card_no }}
        </div>
        <div class="user">
            姓名：{{ username }} &nbsp;&nbsp;&nbsp;&nbsp;
            电话：{{ cellphone }}
        </div>
    </div>
</template>
<script>
    export default {
        props:['card_no','username','cellphone']
    }
</script>
<style lange="less" scoped>
    /*.clear{clear:both;height:0px;overflow:hidden;}*/
    .card-message{
        display: block;
        /*margin: 5px;*/
        padding: 5px;
        border: 1px solid #dddddd;
        border-bottom: 0;
    }
    .card-message:after{
        clear: both;
        display: block;
        content: " ";
    }
    .number{
        float: left;
        width: 30%;
    }
            .user{
        float: left;
        width: 30%;
    }

</style>