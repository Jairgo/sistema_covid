var request = new XMLHttpRequest()

request.open('GET', 'https://api.covid19api.com/summary', true)

var data;
request.onload = function() {
    data = JSON.parse(this.response);
    data['Countries'].sort(function(a,b){
        return b.TotalConfirmed - a.TotalConfirmed;
    });
    
    updateData(searchBar.value);

    for(let i=0;i<data.Countries.length;i++){
        let traduccion = dict[data.Countries[i].Country];
        if(traduccion){
            data.Countries[i].Country = dict[data.Countries[i].Country];
        }
    }

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

let confirmados_element = document.getElementById("Confirmados");
let muertes_element = document.getElementById("Muertes");
let recuperados_element = document.getElementById("Recuperados");
let infogeneral_element = document.getElementById("InfoGeneral");
function updateData(country){
    country = country.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    var countryId = -1;
    var indexOfName = -1;
    for(let i=0;i<data.Countries.length;i++){
        let iof = data.Countries[i].Country.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().indexOf(country);
        if(iof != -1){
            if(countryId == -1 || iof < indexOfName){
                countryId = i;
                indexOfName = iof;
            }
        }
    }
    if(countryId == -1 || country.length == 0){
        confirmados_element.innerHTML = data['Global']['TotalConfirmed'] + " Confirmados";
        muertes_element.innerHTML = data['Global']['TotalDeaths'] + " Muertes";
        recuperados_element.innerHTML = data['Global']['TotalRecovered'] + " Recuperados";
        infogeneral_element.innerHTML = "Información general global";
        drawCharts("","");
    }else{
        confirmados_element.innerHTML = data.Countries[countryId]['TotalConfirmed'] + " Confirmados";
        muertes_element.innerHTML = data.Countries[countryId]['TotalDeaths'] + " Muertes";
        recuperados_element.innerHTML = data.Countries[countryId]['TotalRecovered'] + " Recuperados";
        infogeneral_element.innerHTML = "Información general de " + data.Countries[countryId].Country;
        drawCharts(data.Countries[countryId].Country, data.Countries[countryId].Slug);
    }
}

let searchBar = document.getElementById('searchBar');
searchBar.oninput = function(e){
    updateData(e.target.value);
};