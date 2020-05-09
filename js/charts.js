google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    drawChart1();
    drawChart2();
    drawChart3();
}

var chartTextStyle = {color: '#FFF'};

function drawChart1() {

var data = google.visualization.arrayToDataTable([
    ['Rubro', 'Cantidad'],
    ['Confirmados', 11],
    ['Negativos', 2],
    ['Muertes', 2],
    ['Recuperados', 2]
]);

var options = {
    title: 'Casos en los últimos 14 días',
    //chartArea: {left:10,top:20,width:'100%',height:'100%'},
    //backgroundColor: { fill:'transparent' }
};

var chart = new google.visualization.PieChart(document.getElementById('chartContainer1'));

chart.draw(data, options);
}

function drawChart2() {
    var data = google.visualization.arrayToDataTable([
      ['Rubro', 'Cantidad'],
      ['Confirmados', 11],
      ['Negativos', 2],
      ['Muertes', 2],
      ['Recuperados', 2]
    ]);

    var options = {
      title: 'Casos Acumulados',
      pieHole: 0.4,
    };

    var chart = new google.visualization.PieChart(document.getElementById('chartContainer2'));
    chart.draw(data, options);
}

function drawChart3() {
    var data = google.visualization.arrayToDataTable([
      ['Fecha', 'Casos Acumulados'],
      ['01-Ene-2020', 1000],
      ['01-Feb-2020', 1170],
      ['01-Mar-2020', 1660],
      ['01-Abr-2020', 2030]
    ]);

    var options = {
      title: 'Casos Acumulados en el Tiempo',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chartContainer3'));

    chart.draw(data, options);
}
