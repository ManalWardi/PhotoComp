<?php

$servername= "localhost";
$username= "root";
$password="";
$database="Competition";

  //Create Connexion
  $connection = new mysqli($servername, $username , $password,$database );





$nomPar="";
$prenomPar="";
$agePar="";
$genrePar="";
$emailPar="";
$telPar="";
$titre="";
$image="";
$idComp="";

$errorMessage="";
$successMessage="";


if($_SERVER['REQUEST_METHOD'] == 'GET'){


    if(!isset($_GET['idPar'])){
        header("location:gestionParticipant.php");
        exit; 
    }
    $idPar = $_GET["idPar"];

    //read the row of the selected participant from database table
     $sql= "SELECT * FROM participant WHERE idPar=$idPar " ;
     $result= $connection->query($sql);
     $row = $result->fetch_assoc( ); //read from database


     if(!$row){
        header("location: gestionParticipant.php");
        exit;
     }
     $nomPar = $row["nomPar"];
     $prenomPar = $row["prenomPar"];
     $agePar = $row["agePar"];
     $genrePar = $row["genrePar"];
     $emailPar = $row["emailPar"];
     $telPar = $row["telPar"];
     $titre = $row["titre"];
     $image = $row["image"];
     $idComp = $row["idComp"];


}
    else
    {    // update data of the participant
    $idPar = $_POST['idPar'];
    $nomPar = $_POST['nomPar'];
    $prenomPar = $_POST['prenomPar'];
    $agePar = $_POST['agePar'];
    $genrePar = $_POST['genrePar'];
    $emailPar = $_POST['emailPar'];
    $telPar = $_POST['telPar'];
    $titre = $_POST['titre'];
    $image = $_POST['image'];
    $idComp = $_POST['idComp'];

       // do {
        if ( empty($idPar)|| empty($nomPar)|| empty($prenomPar)|| empty($agePar)|| empty($genrePar)|| empty($emailPar)|| empty($telPar)|| empty($titre)|| empty($image)|| empty($idComp)){
            $errorMessage = "tous les champs sont importants ";
           // break;
     }
 //   $sql = "UPDATE `participants` SET `nomPar`=\'[value-1]\',`prenomPar`=\'[value-2]\',`agePar`=18,`emailPar`=\'[value-4]\',`telPar`=8755456,`adrPar`=\'[value-6]\' WHERE 1;";

    $sql = "UPDATE `participant` SET `nomPar` = '$nomPar',`prenomPar`= '$prenomPar',`agePar`= '$agePar',`genrePar`= '$genrePar',`emailPar`= '$emailPar',`telPar`= '$telPar',`titre`= '$titre',`image`= '$image',`idComp`= '$idComp' WHERE idPar = $idPar ";
            $result = $connection->query($sql);
    if(!$result){
        $errorMessage = "invalid query : " .$connection->error ;
       // break ;
    }
    $successMessage = "Participant updated correctly";

    header("location: gestionParticipant.php");


}


       // }while (false);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
<?php include('headerAdmin.php');?>
    <div class="container my-5">
        <h2>Modifier Participant</h2>

        <?php
        if (!empty($errorMessage)){
        echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong> $errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";

        }
        ?>


        <form action="" method="POST">
            <input type="hidden" name="idPar" value="<?php echo $idPar; ?>">
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Nom Participant</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="nomPar" value="<?php echo $nomPar; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Prenom Participant</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenomPar" value="<?php echo $prenomPar; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Age Participant</label>
                 <div class="col-sm-6">
                    <input type="number" class="form-control" name="agePar" value="<?php echo $agePar; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Genre Participant</label>
                 <div class="col-sm-6">
                 <select name="genrePar" class="form-control" value="<?php echo $genrePar; ?>">
                      <option>Femme</option>
                       <option>Homme</option> 
                 </select> 
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Email Participant</label>
                 <div class="col-sm-6">
                    <input type="email" class="form-control" name="emailPar" value="<?php echo $emailPar; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Telephone Participant</label>
                 <div class="col-sm-6">
                    <input type="tel" class="form-control" name="telPar" value="<?php echo $telPar; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Titre Image</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="titre" value="<?php echo $titre; ?>">
                 </div>
            </div>
            <div class="row-mb-3"> Image</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="image" value="<?php echo $image; ?>">
                 </div>
            </div>
            <div class="form-group col-6">
         <label for="competition">Compétition :</label>
         <div class="col-sm-6">
        <select id="idComp" name="idComp">
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
        </div>
            <?php

                if (!empty($successMessage)){
                   echo "
                       <div class='row-mb-3'>
                            <div class='offset-sm-3 col-sm-6'>
                                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong> $successMessage</strong>
                                         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                             </div>
                        </div>
                          ";

                       }

            ?>


            <br>



            <div class="row mb-3">
                <div class=" col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class=" col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="gestionParticipant.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>