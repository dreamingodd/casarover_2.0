<template>
    <div class="casa-page">
    <div class="main-title">
      <h2>民宿介绍</h2>          
    </div>
      <article>
          <template v-for="content in contents">
              <p v-if="content.text">{{{ content.text }}}</p>
              <template v-for="img in content.imgs">
                  <img :src="'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'+img.filepath" alt="" width="100%">
              </template>
          </template>
      </article>
    </div>
</template>
<script>
    export default{
      props: ['contents']
    }
</script>
<style lang="less">
.main-title{
  background: #D2F1F3;
  height: 3rem;
  line-height: 3rem;
  h2{
    width: 20%;
    margin-left: 1rem;
    background: #95D6DA;
    color: #fff;
    font-weight: normal;
  }
}
article{
  padding: 0 .3rem;
  background: #fff;
  p{
    margin: .5rem 0;
    padding: 0 5px;
    line-height: 22px;
    font-size: 14px;
    color: #777;
  }
  img{
    margin: .3rem 0;
  }
}
</style>