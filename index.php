<?php
    include_once("conna.php");
    $url="https://api.covid19api.com/summary";
    $json=file_get_contents($url);
    $datos=json_decode($json,true);
    $count =count($datos["Countries"]);

    for ($i=1; $i < $count; $i++) { 
        $manejo[$i]["name"]=$datos["Countries"][$i]["Country"];
        $manejo[$i]["name2"]=$datos["Countries"][$i]["Country"];
        //echo($manejo[$i]["name"]."<br/>");
        $manejo[$i]["name"]=$code[$manejo[$i]["name"]];
        $manejo[$i]["Total Confirmados"]=$datos["Countries"][$i]["TotalConfirmed"];
        $manejo[$i]["Total Muertes"]=$datos["Countries"][$i]["TotalDeaths"];
        //$manejo[$i]["Total_Muertes"]=$datos["Countries"][$i]["TotalDeaths"];
    }
    //var_dump($manejo);

    function convertDataToChartForm($manejo)
    {
        $newData = array();
        $firstLine = true;

        foreach ($manejo as $dataRow)
        {
            if ($firstLine)
            {
                $newData[] = array_keys($dataRow);
                $firstLine = false;
            }

            $newData[] = array_values($dataRow);
        }
        return $newData;
    }
    convertDataToChartForm($manejo);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistema Covid-19</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


  
  
  <script src="https://kit.fontawesome.com/07baa58181.js" crossorigin="anonymous"></script>
  <!--Boostrap-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script type="text/javascript">
    google.charts.load('current', {'packages':['geochart'],'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'});
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($manejo)); ?>));

        var options = {
            colorAxis: {colors: ['#F0E4DE', '#E90000']} 
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
    }

    </script>
    
  <style>
    
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    body{
        background-color: #f1f1f1;
    }


    .rounded-pill-left {
        border-top-left-radius: 50rem !important;
        border-bottom-left-radius: 50rem !important;
    }
    .rounded-pill-right {
        border-top-right-radius: 50rem !important;
        border-bottom-right-radius: 50rem !important;
    }
    .rounded-t-l-0 {
        border-top-left-radius: 0 !important;
    }
    .rounded-t-r-0 {
        border-top-right-radius: 0 !important;
    }
    .rounded-b-l-0 {
        border-bottom-left-radius: 0 !important;
    }
    .rounded-b-r-0 {
        border-bottom-right-radius: 0 !important;
    }
    .rounded-x-l-0 {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
    .rounded-x-r-0 {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
  </style>
</head>
<body>

<div class="container-fluid text-center" style="margin-top:2rem;">
        <div class="row">
            <div class="col-sm-3">
                <div id="chartContainer1" class="chart-container"></div>
                <hr>
                <div id="chartContainer2" class="chart-container"></div>
                <hr>
                <div>
                    <p><b>Mayor número de casos por país</b></p>
                    <table id="casosPorPais">
                        <tr>
                            <th>País</th>
                            <th>Casos</th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-sm-6">
                <h1>Covid-19</h1>
                <div class="input-group">
                  <input class="form-control border rounded-pill-left border-right-0" type="search" placeholder="Búsqueda" id="searchBar">
                  <span class="input-group-append">
                    <button class="btn btn-outline-secondary border rounded-pill-right border-left-0" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
                <hr>
                <div class="card text-center">
                    <div id="InfoGeneral" class="card-header">
                    Información general
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div id="Confirmados">Confirmados</div><i class="fas fa-head-side-mask"></i>
                                    <div id="Muertes">Muertes</div><i class="fas fa-skull"></i>
                                </div>
                                <div class="col">
                                    <div id="Negativos">Negativos</div>
                                    <div id="Recuperados">Recuperados</div><i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                          </div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div id="chartContainer3" class="chart-container"></div>
                </div>
                <hr>
                <div class="container col">
                    <div id="regions_div" ></div>
                </div>
                
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <a class="twitter-timeline" href="https://twitter.com/opsoms?ref_src=twsrc%5Etfw" height="950">Tweets by opsoms</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>      
                </div>
            </div>
        </div>
</div>

<footer class="container-fluid text-center" style="margin-top:2rem;">
  <p>Sistema de información de Covid-19</p>
</footer>
<script src="js/dict.js"></script>
<script src="js/back-end-connection.js"></script>
<script src="js/charts.js"></script>
</body>
</html>

<script type="text/javascript">
$(document).ready( function () {
    $('#casosPorPais').DataTable();
} );
</script>
