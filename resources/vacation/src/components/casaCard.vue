<template>
    <div class="card">
        <a v-link="{ name:'casa',params:{ id:casa.id },query:{type:type}}">
            <div class="pic" style="background">
                <img :src="casa.headImg" alt="">
            </div>
            <div class="info">
                <h3>{{ casa.name }}</h3>
            </div>
        </a>
    </div>
</template>
<script>
    export default{
      props: ['casa', 'type']
    }
</script>
<style lang="less">
    @h3-size:2rem;
    .card{
        width: 50%;
        float: left;
        position: relative;
        overflow: hidden;
        a{
            display: block;
            overflow: hidden;
            height: 100%;
        }
    }
    .pic{
        width: 94%;
        padding: 2px 3%;
        overflow: hidden;
        img{
            width: 100%;
            height: 100%;
        }
    }
    .info{
        position: absolute;
        width: 100%;
        top: 50%;
        left: 0;
        margin-top: -@h3-size/2;
        text-align: center;
        overflow: hidden;
        white-space: nowrap;
        h3{
            color: #fff;
            font-size: @h3-size;
            font-weight: 600;
        }
    }
</style>