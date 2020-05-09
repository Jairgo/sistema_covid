<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

  
</head>
<body>
        <?php
            $url="https://api.covid19api.com/summary";
            $json=file_get_contents($url);
            $datos=json_decode($json,true);
            $count =count($datos["Countries"]);
        ?>
        <h1> POR PAÍS </h1>
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

        <?php
            $url="https://api.covid19api.com/summary";
            $json=file_get_contents($url);
            $datos=json_decode($json,true);
        ?>   
        <h1>A NIVEL MUNDIAL </h1>
        <p><?php echo("Nuevos confirmados".": ".$datos["Global"]["NewConfirmed"]); ?></p>
        <p><?php echo("Total confirmados".": ".$datos["Global"]["TotalConfirmed"]);  ?></p>
        <p><?php echo("Nuevas Muertes".": ".$datos["Global"]["NewDeaths"]); ?></p>
        <p><?php echo("Total muertes".": ".$datos["Global"]["TotalDeaths"]); ?></p>
        <p><?php echo("Nuevos recuperados".": ".$datos["Global"]["NewRecovered"]); ?></p>
        <p><?php echo("Total recuperados".": ".$datos["Global"]["TotalRecovered"]); ?></p>
        <h1> PARA GRAFICOS - EVOLUCIÓN DE CASOS CONFIRMADOS GLOBAL </h1>


        <h1> PARA GRAFICOS - EVOLUCIÓN DE CASOS CONFIRMADOS EN MEXICO </h1>
        <?php
            $url="https://api.covid19api.com/dayone/country/mexico";
            $json=file_get_contents($url);
            $datos=json_decode($json,true);
            $count =count($datos);
            
            for ($i=0; $i <  $count ; $i++) { 
                $confirmedMexico[$i]=$datos[$i]["Confirmed"];
                echo($array[$i]." / ");
            }
        ?> 
        <h1> PARA GRAFICOS - EVOLUCIÓN DE DEFUNCIONES EN MEXICO </h1>
        <?php
            for ($i=0; $i < 71 ; $i++) { 
                $deadMexico[$i]=$datos[$i]["Deaths"];
                echo($array[$i]." / ");
            }
        ?>
        <h1> PARA GRAFICOS - EVOLUCIÓN DE RECUPERADOS EN MEXICO </h1>
        <?php
            for ($i=0; $i < 71 ; $i++) { 
                $recoverMexico[$i]=$datos[$i]["Recovered"];
                echo($array[$i]." / ");
            }
        ?>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<?php      

////////////////////////////INFORMACIÓN GRAL MUNDIAL///////////////////////////////////////
$url="https://api.covid19api.com/summary";
$json=file_get_contents($url);
$datos=json_decode($json,true);
$var=$datos["Global"]["NewConfirmed"]." ".$datos["Global"]["TotalConfirmed"]." ".$datos["Global"]["NewDeaths"]
." ".$datos["Global"]["TotalDeaths"]." ".$datos["Global"]["NewRecovered"]." ".$datos["Global"]["TotalRecovered"];



////////////////////////////////////////////////////////////////
/*$var="mexico";
$url="https://api.covid19api.com/live/country/".$var."/status/confirmed";

$json=file_get_contents($url);
$datos=json_decode($json,true);
$var=$datos[0]["Date"];
echo($var);
//echo();*/
?>