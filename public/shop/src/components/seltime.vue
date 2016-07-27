<template>
    <div class="sel-time">
        <input type="text" class="form-control" @click="showCalendar" v-model="value" placeholder="选择查询范围">
        <calendar :show.sync="show" :value.sync="value" :x="x" :y="y" :begin="begin" :end="end" :range="range"></calendar>
    </div> 
</template>
<script>
export default {
    data(){
        return{
          show: false,
          type: 'date',
          x: 0,
          y: 0,
          range: true
        }
    },
    props:['value'],
    watch:{
        value:function(value){
            this.$dispatch('sel-date', this.value);
        }
    },
    methods: {
        showCalendar: function (e) {
          e.stopPropagation()
          this.show = true
          var that = this
          this.y = 0;
          let bindHide = function (e) {
            e.stopPropagation()
            that.show = false
            document.removeEventListener('click', bindHide, false)
          }
          setTimeout(function () {
            document.addEventListener('click', bindHide, false)
          }, 500)
        }
    },
    components: {
        calendar: require('./calendar.vue')
    }
}
</script>
<style>
    .sel-time{
        margin: 10px 0;
        width: 30%;
        float: left;
    }
</style>