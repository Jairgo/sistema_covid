var request = new XMLHttpRequest()

request.open('GET', 'https://api.covid19api.com/summary', true)

request.onload = function() {
    var data = JSON.parse(this.response);
    var confirmados_element = document.getElementById("Confirmados");
    confirmados_element.innerHTML = data['Global']['TotalConfirmed'] + " Confirmados";
    var muertes_element = document.getElementById("Muertes");
    muertes_element.innerHTML = data['Global']['TotalDeaths'] + " Muertes";
    var confirmados_element = document.getElementById("Recuperados");
    confirmados_element.innerHTML = data['Global']['TotalRecovered'] + " Recuperados";

    data['Countries'].sort(function(a,b){
        return b.TotalConfirmed - a.TotalConfirmed;
    });
    var casosPorPais_element = document.getElementById("casosPorPais");
    for(let i=0;i<10;i++){
        var row = casosPorPais_element.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = data.Countries[i].Country;
        cell2.innerHTML = data.Countries[i].TotalConfirmed; 
    }
}

request.send()
