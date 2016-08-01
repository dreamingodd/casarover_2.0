@extends('back')

@section('title', '探庐者后台-经销商管理')

@section('head')
<script src="//cdn.bootcss.com/vue/1.0.26-csp/vue.js"></script>
<script src="/assets/js/integration/json2.js"></script>

<script>
$(function(){
    Vue.component('dealer-list', {
        template : '#dealer-list-template',
        props: ['list'],
        methods : {
            copyToBoard : function(str) {
                $('#showString').html(str);
            },
            edit : function(id) {
                location.href = "/back/dealer/edit/" + id;
            }
        }
    });
    new Vue({
        el : '#dealer_app',
        data : {
            dealers : []
        },
        created : function() {
            this.dealers = JSON.parse($('#jsonDealers').val());
        }
    });
});
</script>
@stop

@section('body')

    <input type="hidden" id="page" value="reserve"/>

    <input type="hidden" id="jsonDealers" value="{{ $jsonDealers }}"/>
    <div class="options vertical5">
        <a href="/back/dealer/edit">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
    <div id="dealer_app">
        <dealer-list :list="dealers"></dealer-list>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="showString" style="text-align:center;"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Template -->
    <template id="dealer-list-template">
        <table class="table table-hover">
            <tr>
                <th>序号</th>
                <th>名称</th>
                <th>链接模式</th>
                <th>抵价券模式</th>
                <th>Code</th>
                <th>操作</th>
            </tr>
            <tr v-for="dealer in list">
                <td>@{{ $index+1 }}</td>
                <td>@{{ dealer.name }}</td>
                <td>@{{ dealer.deal_mode }}</td>
                <td>@{{ dealer.coupon_mode }}</td>
                <td>@{{ dealer.code }}</td>
                <td>
                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" @click="copyToBoard('http://www.casarover.com/wx/cardCasaList?dealer=' + dealer.code)">显示URL</button>
                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" @click="copyToBoard(dealer.key)">显示密钥</button>
                    <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal" @click="copyToBoard(dealer.dev_key)">测试密钥</button>
                    <button class="btn btn-xs btn-primary" @click="edit(dealer.id)">编辑</button>
                </td>
            </tr>
        </table>
    </template>
@stop
