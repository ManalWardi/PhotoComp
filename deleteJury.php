<?php
 $servername= "localhost";
 $username= "root";
 $password="";
 $database="competition";

 //create connection 
 $connection = new mysqli($servername, $username , $password,$database );
 
if ( isset($_GET["idJury"])){
    $idJury= $_GET["idJury"];

   

    $sql = "DELETE FROM Jury WHERE idJury=$idJury";
    $connection->query($sql);
  
}
header("location: gestionJury.php");
exit;


?>