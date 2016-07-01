@extends('back')

@section('title', '约睡分析')
@section('head')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
$(function(){
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawDateChart);
    google.charts.setOnLoadCallback(drawVoteChart);
    google.charts.setOnLoadCallback(drawIndividualChart);

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
function drawIndividualChart() {
    var rawData = eval("(" + $('#individualData').val() + ")");
    var rollData = [];
    rollData.push(["Element", "Density", { role: "style" } ]);
    var rankColors = ['gold', 'silver', 'b87333'];
    for (var key in rawData) {
        console.log(rawData[key]);
        var rank = parseInt(key) + 1;
        if (rank <= 3) {
            rollData.push([rawData[key].nickname + " - 第" + rank + "名", rawData[key].vote_count, rankColors[key]]);
        } else {
            rollData.push([rawData[key].nickname + " - 第" + rank + "名", rawData[key].vote_count, ""]);
        }
    }
    var data = google.visualization.arrayToDataTable(rollData);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

    var options = {
        title: "勤劳的小蜜蜂",
        height: 888,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
    };
    var chart = new google.visualization.BarChart(document.getElementById("individualChart"));
    chart.draw(view, options);
  }
</script>
@endsection
@section('body')
    <input type="hidden" id="page" value="system"/>

    <input type="hidden" id="dateData" value="{{$dateData or ''}}"/>
    <input type="hidden" id="voteData" value="{{$voteData or ''}}"/>
    <input type="hidden" id="individualData" value="{{$individualData or ''}}"/>

    <div id="dateChart" style="min-height: 333px;"></div>
    <div id="voteChart" style="min-height: 333px;"></div>
    <div id="individualChart"></div>
@endsection
