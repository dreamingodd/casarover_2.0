@extends('back')

@section('title', '约睡分析')
@section('head')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
$(function(){
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawDateChart);
    google.charts.setOnLoadCallback(drawVoteChart);

});
function drawDateChart() {
    // Convert the raw mysql data to the google chart's need.
    var rawData = eval("(" + $('#dateData').val() + ")");
    console.log(rawData);
    var specialData = [];
    specialData.push(["时间", "人数", "第一次约睡人数"]);
    for (var key in rawData) {
        specialData.push([key, rawData[key].quantity, rawData[key].virginQuantity]);
    }
    // Below are google's codes
    var data = google.visualization.arrayToDataTable(specialData);
    var options = {
        title: '约睡： ' + {{$dateVirginCount}} + "名用户参与约睡，" + "共约了" + {{$dateCount}} + "次",
        curveType: 'function',
        colors: ['#99ccff', '#99ff33'],
        legend: { position: 'top' }
    };
    var chart = new google.visualization.LineChart(document.getElementById('dateChart'));
    chart.draw(data, options);
}
function drawVoteChart() {
    // Convert the raw mysql data to the google chart's need.
    var rawData = eval("(" + $('#voteData').val() + ")");
    console.log(rawData);
    var specialData = [];
    specialData.push(["时间", "人数", "第一次投票人数"]);
    for (var key in rawData) {
        specialData.push([key, rawData[key].quantity, rawData[key].virginQuantity]);
    }
    // Below are google's codes
    var data = google.visualization.arrayToDataTable(specialData);
    var options = {
        title: '投票： ' + {{$voteVirginCount}} + "名用户参与投票，" + "共投了" + {{$voteCount}} + "票",
        curveType: 'function',
        colors: ['#99ccff', '#99ff33'],
        legend: { position: 'top' }
    };
    var chart = new google.visualization.LineChart(document.getElementById('voteChart'));
    chart.draw(data, options);
}
</script>
@endsection
@section('body')
    <input type="hidden" id="page" value="system"/>

    <input type="hidden" id="dateData" value="{{$dateData or ''}}"/>
    <input type="hidden" id="voteData" value="{{$voteData or ''}}"/>

    <div id="dateChart" style="min-height: 333px;"></div>
    <div id="voteChart" style="min-height: 333px;"></div>
@endsection
