@extends('back')

@section('title', '探庐者后台-度假卡条目')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="/assets/js/integration/vue.js" type="text/javascript"></script>
<script src="/assets/js/vacation.js"></script>
<style>
.input_number {
    width: 100px;
}
</style>
@stop
@section('body')
    <input type="hidden" id="page" value="reserve"/>
    <div class="col-md-4" style="margin: 10px">
        <input type="text" id="select-casa" class="form-control disabled" data-toggle="modal"
               data-target="#casaSelectModal" readonly value="选择民宿">
        <p class="text-danger">ps:如果选择中没有请新建</p>
        <a href="/back/wx/casa">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>新建
        </a>
    </div>
    <div id="app">
        <table class="table">
            <thead>
            <tr>
                <th>序号</th>
                <th>从属民宿</th>
                <th>产品/房间</th>
                <th>原价</th>
                <th>价格</th>
                <th>库存</th>
                <th>包幢</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="p in vacaProducts">
                <tr transition="expand" >
                    <td>
                        @{{ $index+1 }}
                    </td>
                    <td>
                        @{{ p.casaName }}
                    </td>
                    <td class="input_number">
                        <input type="text" class="form-control input-sm" value="@{{ p.name }}" id="name@{{ p.id }}">
                    </td>
                    <td class="input_number">
                        <input type="text" class="form-control input-sm" value="@{{ p.orig }}" id="orig@{{ p.id }}">
                    </td>
                    <td class="input_number">
                        <input type="text" class="form-control input-sm" value="@{{ p.price }}" id="price@{{ p.id }}">
                    </td>
                    <td class="input_number">
                        <input type="text" class="form-control input-sm" value="@{{ p.surplus }}" id="surplus@{{ p.id }}">
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;
                        <input @click="clickIsWhole(p.id)" type="checkbox" id="isWhole@{{ p.id }}" v-model="p.isWhole"/>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" v-on:click="save(p.id)">更新</button>
                        <button class="btn btn-sm btn-danger" v-on:click="del(p.id)">删除</button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>

        {{--所有民宿内容--}}
        <div class="modal fade" id="casaSelectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">搜索</h4>
                    </div>
                    <div class="modal-body" style="height:500px; overflow:scroll;">
                        <div class="search">
                            <input type="text" value="" id="search" />
                            <button class="glyphicon glyphicon-search" type="button" id="enlarge"></button>
                            <button class="glyphicon glyphicon-repeat" type="button" id="reset"></button>
                        </div>
                        <table class="table table-hover">
                            @foreach($casas as $casa)
                                <tr>
                                    <td>{{ $casa->code }}</td>
                                    <td>{{ $casa->name }}</td>
                                    <td><button type="button" class="btn btn-info btn-sm" data-dismiss="modal" v-on:click="add({{ $casa->id }})" >添加</button></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
