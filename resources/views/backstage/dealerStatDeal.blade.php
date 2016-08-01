@extends('back')

@section('title', '探庐者后台-经销商链接统计')

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
            <th>序号</th>
            <th>经销商</th>
            <th>code</th>
            <th>度假卡数量</th>
            <th>总额</th>
            <th>佣金</th>
        </tr>
        <?php $number=1;?>
        @foreach ($stats as $stat)
            <tr>
                <td>{{$number++}}</td>
                <td>{{$stat->name}}</td>
                <td>{{$stat->code}}</td>
                <td>{{$stat->count or 0}}</td>
                <td>{{$stat->total or 0}}</td>
                <td>{{$stat->commission or 0}}</td>
            </tr>
        @endforeach
    </table>
@stop
