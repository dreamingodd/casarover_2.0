<template>
    <article>
        <template v-for="content in contents">
            <p v-if="content.text">{{{ content.text }}}</p>
            <template v-for="img in content.imgs">
                <img :src="'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'+img.filepath" alt="" width="100%">
            </template>
        </template>
    </article>
</template>
<script>
    export default{
      props: ['contents']
    }
</script>
<style lang="less">
article{
  padding: 0 .3rem;
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