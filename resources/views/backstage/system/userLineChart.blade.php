@extends('back')

@section('title', '用户分析')
@section('head')
<script src="/assets/js/integration/google/chart/google.chart.js"></script>
<script type="text/javascript">
$(function(){
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        // Convert the raw mysql data to the google chart's need.
        var rawData = eval("(" + $('#data').val() + ")");
        if (rawData.length == 0) {
            alert("无数据！");
        } else {
            var specialData = [];
            specialData.push(["时间", "人数"]);
            for (var key in rawData) {
                specialData.push([key, rawData[key]]);
            }
            // Below are google's codes
            var data = google.visualization.arrayToDataTable(specialData);
            var options = {
                title: '登录新用户',
                curveType: '{{$curveType}}',
                legend: { position: 'bottom' }
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    }

})
</script>
@endsection
@section('body')
    <input type="hidden" id="page" value="system"/>

    <input type="hidden" id="data" value="{{$data or ''}}"/>

    <form style="margin-left: 100px;" action="/back/system/user/analyze">
        月份查询：
        <select id="year" name="year">
            <option value="{{$year or ''}}">{{$year or ''}}</option>
            <?php
            for ($year = 2016; $year <= 2016; $year++) {
            ?>
                <option value="<?php echo $year ?>"><?php echo $year ?></option>
            <?php
            }
            ?>
        </select>
        <select id="month" name="month">
            <option value="{{$month or ''}}">{{$month or ''}}</option>
            <?php
            for ($month = 5; $month <= 12; $month++) {
            ?>
                <option value="<?php echo $month ?>"><?php echo $month ?></option>
            <?php
            }
            ?>
        </select>&nbsp;
        样式：
        <select id="curveType" name="curveType">
            <option value="{{$curveType}}">{{$curveType=='none' ? 'Sharp':'Mellow'}}</option>
            <option value="function">Mellow</option>
            <option value="none">Sharp</option>
        </select>
        <input type="submit" value="查询"/>
    </form>

    <div id="chart_div" style="min-height: 400px;"></div>
@endsection
