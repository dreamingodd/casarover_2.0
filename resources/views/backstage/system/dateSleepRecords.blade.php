@extends('back')

@section('title', '用户分析')
@section('head')
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 2px;
}
</style>
<script type="text/javascript">
$(function(){

})
</script>
@endsection
@section('body')
    <input type="hidden" id="page" value="system"/>

    <input type="hidden" id="data" value="{{$data or ''}}"/>
    <button onclick="history.go(-1);">返回</button>
    <h4><strong>{{$username}}</strong>&nbsp;共获得&nbsp;<strong>{{$count}}</strong>&nbsp;票：</h4>
    <table class="table recordTable">
        <tr>
            <th>序号</th>
            <th>民宿</th>
            <th>投票人</th>
            <th>时间（倒序）</th>
        </tr>
        <?php $rowCount = 1; ?>
        @foreach($result as $row)
        <tr>
            <td>{{$rowCount++}}</td>
            <td>{{$row->casa_name}}</td>
            <td>{{$row->nickname}}</td>
            <td>{{$row->created_at}}</td>
        </tr>
        @endforeach
    </table>
@endsection
