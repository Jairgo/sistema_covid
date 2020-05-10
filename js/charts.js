google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawCharts(""));

//google.charts.load('current', {'packages':['geochart'],'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'});
//google.charts.setOnLoadCallback(drawRegionsMap);




function drawCharts(countryName, countrySlug) {
  if(countrySlug != ""){
    var request = new XMLHttpRequest()
    
    request.open('GET', 'https://api.covid19api.com/total/dayone/country/'+countrySlug, true)

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
          let date = new Date(data[i].Date);
          date = date.getUTCDate()+'/'+(date.getUTCMonth()+1)+'/'+date.getUTCFullYear();
          data3.push([date, parseInt(data[i].Confirmed)]);
        }
        
        drawChart1(data1, countryName);
        drawChart2(data2, countryName);
        drawChart3(data3, countryName);
    }

    request.send()
  }else{
    // Global charts
    drawCharts("México", "mexico");
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
    data = google.visualization.arrayToDataTable(data);

    var options = {
      title: country != "" ? 'Casos acumulados a través del tiempo. ' + country : 'Casos acumulados a través del tiempo',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chartContainer3'));

    chart.draw(data, options);
}

/*
function drawRegionsMap() {
  var data = google.visualization.arrayToDataTable([
    ['Country', 'Popularity'],
    ['DE', 200],
    ['US', 300],
    ['BR', 400],
    ['CA', 500],
    ['FR', 600],
    ['RU', 700]
  ]);

  var options = {};

  var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

  chart.draw(data, options);
}*/
