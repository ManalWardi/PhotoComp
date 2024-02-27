<?php

if ( isset($_GET["idComp"])){
    $idComp = $_GET["idComp"];

    $servername= "localhost";
    $username= "root";
    $password="";
    $database="competition";

    //create connection 
    $connection = new mysqli($servername, $username , $password,$database );

    $sql = "DELETE FROM Comp WHERE idComp='$idComp'";
    $connection->query($sql);
  
}
header("location: gestionComp.php");
exit;


?>