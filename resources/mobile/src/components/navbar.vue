<template>
    <nav class="navbar">
        <div class="navcon">
            <div class="nav-card">
                <a href="/mobile/allcasa" style="background: #00CCFF">民宿大全</a>
            </div>
            <div class="nav-card">
                <a href="/mobile/home#recom" style="background:#C391E2 ">民宿推荐</a>
            </div>
            <div class="nav-card">
                <a href="/mobile/home#theme" style="background: #87DB83">精选主题</a>
            </div>
            <div class="nav-card">
                <a href="/mobile/home#series" style="background: #6699FF">探庐系列</a>
            </div>
        </div>
    </nav>    
</template>
<style lang="less">
nav{
  overflow: hidden;
  margin-bottom: 1rem;
}
.nav-card{
  width: 48%;
  margin-left: 1%;
  margin-right: 1%;
  margin-top: 1rem;
  height: 3rem;
  line-height: 3rem;
  float: left;
  background: #c1e2b3;
}
.navcon{
  text-align: center;
  a{
    display: block;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    background: #5cb85c;
  }
}
</style>