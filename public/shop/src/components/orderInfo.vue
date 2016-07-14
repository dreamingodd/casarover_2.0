<template>
    <table class="table table-bordered">
        <tr>
            <td>订单号</td>
            <td>入住人信息</td>
            <td>房型/数量</td>
            <td>时间</td>
            <td>备注</td>
            <td>操作</td>
        </tr>
        <tr>
            <td>{{ order.order_id }}</td>
            <td>
                姓名：{{ order.username }}
                <p>电话：{{ order.userphone }}</p>
            </td>
            <td>
                <template v-for="good in order.goods">
                    {{ good.name }}--{{ good.quantity}}
                </template>
            </td>
            <td class="time-input">
                <input type="text" class="form-control" @click="showCalendar" v-model="order.reserveDate" placeholder="请输入日期">
                <calendar :show.sync="show" :value.sync="order.reserveDate" :x="x" :y="y" :begin="begin" :end="end" :range="range"></calendar>                
            </td>
            <td>
                <input type="text" class="form-control" v-model="order.reserveComment">
            </td>
            <td>
                <button class="btn btn-default" @click="save(order.id,order.reserveDate,order.reserveComment)">确认</button>
                <button class="btn btn-danger" @click="del(order.id)">取消预约</button>
            </td>
        </tr>
    </table>
</template>
<script>
export default {
  data () {
    return {
      show: false,
      type: 'date',
      // value: null,
      // begin: '2015-12-20',
      // end: '2015-12-25',
      x: 0,
      y: 0,
      range: false
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
    },
    save:(id,date,message)=>{
        $.ajax('/api/merch/changeorder', {
            type: 'post',
            data: {
                'id':id,
                'reserveDate':date,
                'reserveComment':message
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: (data)=>{
                if (data.code === 0) {
                    alert('更新成功');
                }else{
                    alert('更新失败，请刷新重试');
                    console.log(data);
                }
            }
        });        
    },
    del: function(id){
        $.getJSON('/api/merch/delorder/'+id, (data) => {
            if(data.code === 0){
                this.$dispatch('child-msg');                
            }else{
                alert('出错了，请刷新重试');
            };
        });        
    }
  },
  components: {
    calendar: require('./calendar.vue')
  },
  props: ['order']
}
</script>