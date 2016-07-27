<template>
      <template v-if="pages > 1">
        <nav>
          <ul class="pagination">
            <template v-for="n in pages">
                <li v-if="(n+1) == page"  v-link="{ query: {page: n+1 },exact: true}"><a class="pactive" href="">{{ n+1 }}</a></li>
                <li v-else v-link="{ query: {page: n+1 },exact: true}"><a href="">{{ n+1 }}</a></li>
            </template>
          </ul>
        </nav>
      </template>
</template>
<script>
    export default {
        props:['pages','page']
    }
</script>
<style>
    .pagination>li>.pactive{
        background: #337ab7;
        color: #fff;
    }
    .pagination>li>.pactive:hover{
        background: #337ab7;
        color: #fff;
    }
</style>