<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Gestion Participants</title>

</head>
 <body>
<!-- header section starts  -->
<?php include 'header.php'; ?>
<!-- header section ends -->
<?php 

$host='localhost';
$dbname='Competition';
$username='root';
$password='';
try{
    $db = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    //Definir mode d'erreur de PDO a Exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die('Erreur:'.$e->getMessage());
}

$query = "SELECT COUNT(*) AS total FROM Participant";
$result = $db->query($query);

if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $submissions = $row['total'];
} else {
    $submissions = 0;
}





// Limite de soumissions
$limit = 60; ?>
<br>

<div class="account-form" >
    <form method="POST" enctype="multipart/form-data" action="ajoutercandidature.php">
        <h3>Remplissez ce formulaire pour participer</h3>
        <p class="placeholder"><label>Nom:</label></p>
        <input type="text" class="box" name="nomPar">
        <p class="placeholder"><label>Prénom:</label></p>
        <input type="text" class="box" name="prenomPar">
        <p class="placeholder"><label>Email:</label></p>
        <input type="text" class="box" name="emailPar">
        <p class="placeholder"><label>telephone:</label></p>
        <input type="text" class="box" name="telPar">
        <p class="placeholder"><label>Age:</label></p>
        <input type="number" class="box" name="agePar">
        <p class="placeholder"><label>Genre</label></p>
            <select class="box" name="genrePar" >
            <option>Femme</option>
             <option>Homme</option> 
            </select>  
        <p class="placeholder"><label>Titre:</label></p>
        <input type="text" class="box" name="titre">
        <p class="placeholder">Image:</p>
        <input type="file" name="image" class="box" accept="image/*">
        <div class="form-group col-6">
         <p class="placeholder">Compétition :</p>
        <select class="box" id="idComp" name="idComp">
            <?php
           $servername = "localhost";
           $username = "root";
           $password = "";
           $database = "Competition";

           //create connection 
           $connection = new mysqli($servername, $username , $password,$database );

           // check connection
           if ($connection->connect_error){
               die("connection failed" .$connection->connect_error) ;
           }

           // read all row from database table
           $sql= "SELECT * FROM Comp";
           $result= $connection->query($sql);

           if (!$result){
                die("invalid query:".$connection->error);
           }
           // read data of each row 
           while($row = $result->fetch_assoc()){
            echo "<option value='" . $row['idComp'] . "'>" . $row['idComp'] . "</option>";
           }
                    
            ?>
        </select>
         </div>
      

        <button type="submit" class="btn">Ajouter</button>
    </form>
</div>




<!-- ... Fin du code HTML ... -->
        
  <script src="script.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </body>
</html>