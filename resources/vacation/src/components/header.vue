<template>
    <nav>
        <div class="nav-left">
            <a v-if="back" onclick="history.go(-1)">
                <img src="/static/header/back.png" height="100%" alt="" />
            </a>
            <a v-else href="/wx">
                <img src="/static/header/home.png" height="100%" alt="" />
            </a>
        </div>
        <div class="logo">
            <h2 v-if="title">{{ title }}</h2>
            <img v-else src="/static/header/logow.png" height="100%"/>
        </div>
        <div class="nav-right">
            <a href="/wx/user">
                <img src="/static/header/user.png" height="100%" alt="" />
            </a>
        </div>
    </nav>
</template>
<script>
    export default{
      props: ['title', 'back']
    }
</script>
<style lang="less">
@header-color:#95d6da;
@header-height:5rem;
header{
    z-index: 1023;
    height: @header-height;
    width: 100%;
    position: relative;
}
nav{
    display: block;
    background-color: @header-color;
    height: @header-height;
    line-height: @header-height;
    width: 100%;
    a{
        display: block;
        text-align: center;
    }
    .nav-left{
        width: 20%;
        float: left;
        img{
            width: @header-height/2;
            height: @header-height/2;
        }
    }
    .logo{
        width: 60%;
        float: left;
        text-align: center;
        overflow: hidden;
        white-space: nowrap;
        img{
            height: @header-height/2;
        }
        h2{
            color: #fff;
            margin: 0;
            font-size: 2rem;
        }
    }
    .nav-right{
        width: 20%;
        float: left;
        img{
            width: @header-height/2;
            height: @header-height/2;
        }
    }
}

.fix-top{
    position: fixed;
    top: 0;
    right: 0;
}

</style>