<?php

if ( isset($_GET["idPar"])){
    $idPar = $_GET["idPar"];

    $servername= "localhost";
    $username= "root";
    $password="";
    $database="competition";

    //create connection 
    $connection = new mysqli($servername, $username , $password,$database );

    $sql = "DELETE FROM participant WHERE idPar=$idPar";
    $connection->query($sql);
  
}
header("location: gestionParticipant.php");
exit;


?>