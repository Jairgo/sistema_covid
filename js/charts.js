google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawCharts(""));

function drawCharts(countryName) {
  if(countryName != ""){
    var request = new XMLHttpRequest()
    
    request.open('GET', 'https://api.covid19api.com/total/dayone/country/'+countryName, true)

    request.onload = function() {
        var data;
        data = JSON.parse(this.response);
        
        var data1 = [['Rubro', 'Cantidad'],
          ['Confirmados', data[data.length-1].Confirmed-data[Math.max(data.length-14,0)].Confirmed],
          ['Muertes', data[data.length-1].Deaths-data[Math.max(data.length-14,0)].Deaths],
          ['Recuperados', data[data.length-1].Recovered-data[Math.max(data.length-14,0)].Recovered]];
        var data2 = [['Rubro', 'Cantidad'],
                    ['Confirmados', data[data.length-1].Confirmed],
                    ['Muertes', data[data.length-1].Deaths],
                    ['Recuperados', data[data.length-1].Recovered]];
        var data3 = [['Fecha', 'Casos Acumulados']];
        for(let i=0;i<data.length;i++){
          data3.push([data[i].Date, data[i].Confirmed]);
        }
        
        drawChart1(data1, countryName);
        drawChart2(data2, countryName);
        drawChart3(data3, countryName);
    }

    request.send()
  }else{
    // Global charts
    drawCharts("Mexico");
  }
}

var chartTextStyle = {color: '#FFF'};

function drawChart1(data, country) {

data = google.visualization.arrayToDataTable(data);

var options = {
    title: country != "" ? 'Casos en los últimos 14 días de ' + country : 'Casos en los últimos 14 días globales'
};

var chart = new google.visualization.PieChart(document.getElementById('chartContainer1'));

chart.draw(data, options);
}

function drawChart2(data, country) {
    data = google.visualization.arrayToDataTable(data);

    var options = {
      title: country != "" ? 'Casos acumulados de ' + country : 'Casos acumulados globales',
      pieHole: 0.4,
    };

    var chart = new google.visualization.PieChart(document.getElementById('chartContainer2'));
    chart.draw(data, options);
}

function drawChart3(data, country) {
    var data = google.visualization.arrayToDataTable(data);

    var options = {
      title: country != "" ? 'Casos acumulados en el tiempo de ' + country : 'Casos acumulados en el tiempo globales',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chartContainer3'));

    chart.draw(data, options);
}
