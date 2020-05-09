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
    console.log(data.Countries[0]);
}

request.send()
