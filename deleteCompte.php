<?php
 $servername= "localhost";
 $username= "root";
 $password="";
 $database="competition";

 //create connection 
 $connection = new mysqli($servername, $username , $password,$database );
 
if ( isset($_GET["username"])){
    $username = $_GET["username"];

   

    $sql = "DELETE FROM Comptes WHERE username='$username'";
    $connection->query($sql);
  
}
header("location: gestionCompte.php");
exit;


?>