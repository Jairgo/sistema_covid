<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistema Covid-19</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  <script src="https://kit.fontawesome.com/07baa58181.js" crossorigin="anonymous"></script>

  
  <!--Boostrap-->
    <script src="js/back-end-connection.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
            </div>
            <div class="col">
                <h1>Covid-19</h1>
                <div class="input-group">
                  <input class="form-control border rounded-pill-left border-right-0" type="search" placeholder="Búsqueda" id="example-search-input">
                  <span class="input-group-append">
                    <button class="btn btn-outline-secondary border rounded-pill-right border-left-0" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
                <hr>
                <div class="card text-center">
                    <div class="card-header">
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
                    <?php
                        $url="https://api.covid19api.com/summary";
                        $json=file_get_contents($url);
                        $datos=json_decode($json,true);
                        $count =count($datos["Countries"]);
                    ?>
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>País</th>
                                <th>Nuevos confirmados</th>
                                <th>Total Confirmados</th>
                                <th>Nuevas muertes</th>
                                <th>Total muertes</th>
                                <th>Nuevos recuperados</th>
                                <th>Total recuperados</th>
                
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php 
                                for ($i=0; $i < $count; $i++) {
                                    ?> <tr> <?php
                                    ?><td><?php  echo($datos["Countries"][$i]["Country"]); ?></td><?php
                                    ?><td><?php  echo($datos["Countries"][$i]["NewConfirmed"]); ?></td><?php
                                    ?><td><?php  echo($datos["Countries"][$i]["TotalConfirmed"]); ?></td><?php
                                    ?><td><?php  echo($datos["Countries"][$i]["NewDeaths"]); ?></td><?php
                                    ?><td><?php  echo($datos["Countries"][$i]["TotalDeaths"]); ?></td><?php
                                    ?><td><?php  echo($datos["Countries"][$i]["NewRecovered"]); ?></td><?php
                                    ?><td><?php  echo($datos["Countries"][$i]["TotalRecovered"]); ?></td><?php
                                    ?> </tr> <?php
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <a class="twitter-timeline" href="https://twitter.com/opsoms?ref_src=twsrc%5Etfw" height="600">Tweets by opsoms</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>      
                </div>
            </div>
        </div>
</div>

<footer class="container-fluid text-center" style="margin-top:2rem;">
  <p>Sistema de información de Covid-19</p>
</footer>
<script src="js/charts.js"></script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
