var request = new XMLHttpRequest()

request.open('GET', 'https://api.covid19api.com/summary', true)

var data;
request.onload = function() {
    data = JSON.parse(this.response);
    data['Countries'].sort(function(a,b){
        return b.TotalConfirmed - a.TotalConfirmed;
    });
    
    updateData();

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

function updateData(country){
    var countryId = -1;
    for(let i=0;i<data.Countries.length;i++){
        if(data.Countries[i].Country.indexOf(country) == 0){
            countryId = i;
            break;
        }
    }
    if(countryId == -1){
        var confirmados_element = document.getElementById("Confirmados");
        confirmados_element.innerHTML = data['Global']['TotalConfirmed'] + " Confirmados";
        var muertes_element = document.getElementById("Muertes");
        muertes_element.innerHTML = data['Global']['TotalDeaths'] + " Muertes";
        var confirmados_element = document.getElementById("Recuperados");
        confirmados_element.innerHTML = data['Global']['TotalRecovered'] + " Recuperados";
        var infogeneral_element = document.getElementById("InfoGeneral");
        infogeneral_element.innerHTML = "Información general global";
    }else{
        // console.log("Country: " + data.Countries[countryId].Country);
        var confirmados_element = document.getElementById("Confirmados");
        confirmados_element.innerHTML = data.Countries[countryId]['TotalConfirmed'] + " Confirmados";
        var muertes_element = document.getElementById("Muertes");
        muertes_element.innerHTML = data.Countries[countryId]['TotalDeaths'] + " Muertes";
        var confirmados_element = document.getElementById("Recuperados");
        confirmados_element.innerHTML = data.Countries[countryId]['TotalRecovered'] + " Recuperados";
        var infogeneral_element = document.getElementById("InfoGeneral");
        infogeneral_element.innerHTML = "Información general de " + data.Countries[countryId].Country;
    }
}

let searchBar = document.getElementById('searchBar');
searchBar.oninput = function(e){
    updateData(e.target.value);
};