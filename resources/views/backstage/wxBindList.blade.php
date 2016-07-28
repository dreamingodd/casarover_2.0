@extends('back')

@section('title', '探庐者后台-微信商家管理')

@section('head')
<script src="/assets/js/casaSelectModal.js"></script>
<style>
.select_bind_btn {
    margin-bottom: 3px;
}
</style>
<script type="text/javascript">
$(function() {
    $('.select_bind_btn').click(function(){
        $('#bindId').val($(this).attr('db_id'));
    });
    $('.select_casa_btn').click(function(){
        var bindId = $('#bindId').val();
        var casaId = $(this).attr('db_id');
        location.href = '/back/wx/bind/' + bindId + '/' + casaId;
    });
    $('.select_dealer_btn').click(function(){
        var bindId = $('#bindId').val();
        var dealerId = $(this).attr('db_id');
        location.href = '/back/wx/bind/dealer/' + bindId + '/' + dealerId;
    });
});
</script>
@stop

@section('body')

    <input type="hidden" id="page" value="reserve"/>

    <input type="hidden" id="bindId" value=""/>

    <div class="options vertical5">
        <a href="/back/wx/bind">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>列表
        </a>
        <a href="/back/wx/bind/trash/1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>微信名</th>
            <th>手机</th>
            <th>用户输入信息</th>
            <th>绑定民宿|经销商</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        <?php $number=1;?>
        @foreach ($wxBinds as $bind)
            <tr>
                <td>{{$number++}}</td>
                <td>{{$bind->user->realname or ''}}</td>
                <td>{{$bind->user->nickname or ''}}</td>
                <td>{{$bind->user->cellphone or ''}}</td>
                <td>{{$bind->casa_name}}</td>
                <td class="bind_name">
                    @if (!$bind->trashed())
                        <button type="button" db_id="{{$bind->id}}" class="select_bind_btn btn btn-xs btn-info"
                                data-toggle="modal" data-target="#casaSelectModal">民宿</button>
                    @endif
                    <span>{{$bind->wxCasa->name or ''}}</span>
                    <br />
                    @if (!$bind->trashed())
                        <button type="button" db_id="{{$bind->id}}" class="select_bind_btn btn btn-xs btn-info"
                                data-toggle="modal" data-target="#dealerSelectModal">经销商</button>
                    @endif
                    {{$bind->dealer->name or ''}}
                </td>
                <td>{{$bind->updated_at==''?$bind->created_at:$bind->updated_at}}</td>
                <td>
                    @if ($bind->trashed())
                        <a href='/back/wx/bind/restore/{{$bind->id}}'>
                            <button type="button" class="btn btn-xs btn-warning">还原</button>
                        </a>
                    @else
                        <a href='/back/wx/bind/delete/{{$bind->id}}'>
                            <button type="button" class="btn btn-xs btn-danger">删除</button>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    @if (!empty($bind) && !$bind->trashed())
    <!-- Modal for WxCasa Selector. -->
    <div class="modal fade" id="casaSelectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">选择一家民宿</h4>
                </div>
                <div class="modal-body" style="height:500px; overflow:scroll;">
                    <div class="search">
                        <input type="text" value="" id="search" />
                        <button class="glyphicon glyphicon-search" id="enlarge"></button>
                        <button class="glyphicon glyphicon-repeat" id="reset"></button>
                    </div>
                    <div class="alert alert-info" role="alert"
                            style="float: left; padding: 2px; margin: 7px 0 5px 0;">
                        按回车搜索，按Shift重置。
                    </div>
                    <table id="slimCasaTable" class="table table-hover">
                        @foreach ($wxCasas as $casa)
                            <tr>
                                <td>{{$casa->name}}</td>
                                <td><button db_id="{{$casa->id}}" type="button"
                                        class="select_casa_btn btn btn-info btn-xs">
                                    是它</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Dealer Selector. -->
    <div class="modal fade" id="dealerSelectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">选择一个经销商</h4>
                </div>
                <div class="modal-body" style="height:500px; overflow:scroll;">
                    <!--
                    <div class="search">
                        <input type="text" value="" id="search" />
                        <button class="glyphicon glyphicon-search" id="enlarge"></button>
                        <button class="glyphicon glyphicon-repeat" id="reset"></button>
                    </div>
                    <div class="alert alert-info" role="alert"
                            style="float: left; padding: 2px; margin: 7px 0 5px 0;">
                        按回车搜索，按Shift重置。
                    </div> -->
                    <table id="slimCasaTable" class="table table-hover">
                        @foreach ($dealers as $dealer)
                            <tr>
                                <td>{{$dealer->name}}</td>
                                <td><button db_id="{{$dealer->id}}" type="button"
                                        class="select_dealer_btn btn btn-info btn-xs">
                                    就是它</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop
