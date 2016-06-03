@extends('back')
@section('head')
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/eighteen.js"></script>
@stop
@section('body')
    <input type="hidden" id="page" value="reserve"/>
    <div class="options vertical5">
        <a href="/back/wx/vocation/edit">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
        <a href="/back/vocation">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>列表
        </a>
        <a href="/back/wx/vocation/1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div>
    <div id="app">
        <table class="table">
            <thead>
            <tr>
                <th>序号</th>
                <th>度假卡</th>
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
                        <a href='/back/wx/vocation/edit'>
                            <button type="button" class="btn btn-xs btn-info">编辑</button>
                        </a>
                        <a href='/back/wx/vocation/del/0'>
                            <button type="button" class="btn btn-xs btn-warning">还原</button>
                        </a>
                        <a href='/back/wx/vocation/del/1'>
                            <button class="btn btn-xs btn-danger" >删除</button>
                        </a>
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
                            @foreach($cards as $card)
                                <tr>
                                    <td>{{ $card->id }}</td>
                                    <td>{{ $card->name }}</td>
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
