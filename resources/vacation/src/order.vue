<template>
    <nav-head back="1" title="付款"></nav-head>
    <casa></casa>
    <user></user>
    <submit last='1'></submit>
</template>
<script>
    export default{
      data () {
        return {
        }
      },
      components: {
        'nav-head': require('./components/header'),
        'casa': require('./components/order-casa'),
        'submit': require('./components/bottom-submit'),
        'user': require('./components/userinfo')
      }
    }
</script>