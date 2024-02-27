<?php 



try {
    $db = new PDO("mysql:host=localhost;dbname=Competition","root","");
    // Définir le mode d'erreur de PDO à Exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}


if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
 }else{
    $username = '';
    
}
if (isset($_GET['idPar'])) {
    $idPar = $_GET['idPar'];
} else {
    $idPar= '';
    
}

?>