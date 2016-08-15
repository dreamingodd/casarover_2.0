<template>
    <!-- 民宿大图  -->
    <div class="banner">
        <div class="cover-photo">
            <img :src="banner.img" width="100%" alt="">
        </div>
        <div class="guide-mess">
            <h1>{{ banner.title }}</h1>
            <p>{{ banner.brief }}</p>
        </div>
    </div>
</template>
<script>
export default{
  props: ['banner']
}
</script>
<style lang="less" scoped>
.banner{
  position: relative;
  .cover-photo{
    img{
      height: 10rem;      
    }
  }
  .guide-mess{
   position: absolute;
   bottom: 0;
   left: 0;
   top: 50%;
   width: 100%;
   margin-top: -50px;
   z-index: 60;
   overflow: hidden;
   color: #fff;
   text-align: center;
   background: linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,0.3) 50%,rgba(0,0,0,0.8) 100%);
   h1{
     padding-bottom: 10px;
   }
   P{
     text-indent: 2em;
     margin: 0 auto;
     width: 80%;
     word-break: break-word;
     overflow : hidden;
     text-overflow: ellipsis;
     display: -webkit-box;
     -webkit-line-clamp: 2;
     -webkit-box-orient: vertical;
   }
  } 
}
</style>