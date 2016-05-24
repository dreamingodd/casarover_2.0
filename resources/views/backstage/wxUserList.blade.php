@extends('back')

@section('title', '探庐者后台-微信预定民宿管理')

@section('head')
<script type="text/javascript">
</script>
@stop

@section('body')

    <input type="hidden" id="page" value="reserve"/>

    <div class="options vertical5">
    </div>
    <table class="table table-hover">
        <tr>
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
                        <a href='/back/system/wx/user/test/unregister/{{$user->id}}'>
                            <button type="button" class="btn btn-xs btn-warning">取消测试资格</button>
                        </a>
                    @else
                        <a href='/back/system/wx/user/test/register/{{$user->id}}'>
                            <button type="button" class="btn btn-xs btn-info">注册测试用户</button>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@stop
