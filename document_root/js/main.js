function prepareChart(title, axisTitle, data) {
    google.load('visualization', '1.0', {
        'packages':['corechart']
        });
    google.setOnLoadCallback(function(){
        drawChart(title, axisTitle, data)
        });
}
function drawChart(title, axisTitle, data) {
    var dataTable = google.visualization.arrayToDataTable(data);
    var options = {
        title: title,
        interpolateNulls : true,
        hAxis: {
            title: axisTitle
        }
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(dataTable, options);
}