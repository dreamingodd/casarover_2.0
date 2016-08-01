@extends('back')

@section('title', '用户分析')
@section('head')
<script type="text/javascript">
$(function(){

})
</script>
@endsection
@section('body')
    <input type="hidden" id="page" value="activity"/>

    <input type="hidden" id="data" value="{{$data or ''}}"/>
    <br />
    <table class="table">
        <tr>
            <th>民宿</th>
            <th>中奖者</th>
            <th>电话</th>
            <th>票数</th>
            <th>查看</th>
        </tr>
        @foreach($result as $row)
        <tr>
            <td>{{$row->casaname}}</td>
            <td><img style="height:25px;" src="{{$row->headimgurl}}"/>&nbsp;&nbsp;&nbsp;{{$row->nickname}}</td>
            <td>{{$row->cellphone}}</td>
            <td>{{$row->vote}}</td>
            <td><a href="/back/system/datesleep/vote/records/{{$row->user_id}}"><button>查看详细得票信息</button></a></td>
        </tr>
        @endforeach
    </table>
@endsection
