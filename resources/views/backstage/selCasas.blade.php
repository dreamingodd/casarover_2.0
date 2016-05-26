@extends('back')
@section('head')
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/eighteen.js"></script>
@stop
@section('body')
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
                <th>民宿信息</th>
                {{--<th>用户信息</th>--}}
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <template v-for="wxcasa in wxcasas">
                    <tr transition="expand">
                        <th>
                            @{{ $index+1 }}
                        </th>
                        <th scope="row">
                            @{{ wxcasa.name }}
                        </th>
                        <th>
                            <button class="btn btn-xs btn-danger" v-on:click="del(wxcasa.id)">删除</button>
                        </th>
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
