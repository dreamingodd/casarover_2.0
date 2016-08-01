@extends('back')

@section('title', '探庐者后台-经销商抵用券统计')

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
            <th>请求数量</th>
            <th>请求总额</th>
            <th>使用数量</th>
            <th>使用总额</th>
        </tr>
        <?php $number=1;?>
        @foreach ($stats as $stat)
            <tr>
                <td>{{$number++}}</td>
                <td>{{$stat->name}}</td>
                <td>{{$stat->code}}</td>
                <td>{{$stat->requested_count or 0}}</td>
                <td>{{$stat->requested_total or 0}}</td>
                <td>{{$stat->used_count or 0}}</td>
                <td>{{$stat->used_total or 0}}</td>
            </tr>
        @endforeach
    </table>
@stop
