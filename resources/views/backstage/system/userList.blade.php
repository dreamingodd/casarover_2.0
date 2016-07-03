@extends('back')

@section('title', '探庐者后台-微信预定民宿管理')

@section('head')
<script type="text/javascript">
$(function(){
    $('#searchBtn').click(function(){
        var searchText = $('#searchText').val();
        location.href = "/back/system/user?hasPhone={{$hasPhone}}&searchText=" + searchText;
    });
})
</script>
@stop

@section('body')

    <input type="hidden" id="page" value="system"/>

    <div class="options vertical5">
        用户总数：{{ $total }}
        <a href="/back/system/user">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>全部列表
        </a>&nbsp;
        <input type="checkbox"
                @if ($hasPhone)
                    checked
                @endif
        />
        @if ($hasPhone)
            <a href="/back/system/user?hasPhone=0&searchText={{$searchText}}">仅显示带有手机信息的用户</a>
        @else
            <a href="/back/system/user?hasPhone=1&searchText={{$searchText}}">仅显示带有手机信息的用户</a>
        @endif
        &nbsp;
        <input id="searchText" value="{{$searchText or ''}}"/>
        <button id="searchBtn">搜索</button>
    </div>
    {!! $users->appends(['searchText' => $searchText, 'hasPhone' => $hasPhone])->render() !!}
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>头像</th>
            <th>真实姓名</th>
            <th>微信名</th>
            <th>手机</th>
            <th>openid</th>
            <th>性别</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        <?php $number=1;?>
        @foreach ($users as $user)
            <tr>
                <td>{{$number++}}</td>
                <td><img src="{{$user->headimgurl}}" style="height:25px;"/></td>
                <td>{{$user->realname}}</td>
                <td>{{$user->nickname}}</td>
                <td>{{$user->cellphone}}</td>
                <td>{{$user->openid}}</td>
                <td>
                    @if ($user->sex == 1)
                        男
                    @elseif ($user->sex ==2)
                        女
                    @else
                        不详
                    @endif
                </td>
                <td>{{$user->created_at}}</td>
                <td>
                    @if ($user->test)
                        <a href='/back/system/user/test/unregister/{{$user->id}}/{{$page}}/{{$searchText}}/{{$hasPhone}}'>
                            <button type="button" class="btn btn-xs btn-warning">取消测试资格</button>
                        </a>
                    @else
                        <a href='/back/system/user/test/register/{{$user->id}}/{{$page}}/{{$searchText}}/{{$hasPhone}}'>
                            <button type="button" class="btn btn-xs btn-info">注册测试用户</button>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {!! $users->appends(['searchText' => $searchText, 'hasPhone' => $hasPhone])->render() !!}
@stop
