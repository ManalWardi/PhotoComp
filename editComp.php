<?php

$servername= "localhost";
$username= "root";
$password="";
$database="Competition";

  //Create Connexion
  $connection = new mysqli($servername, $username , $password,$database );





  $idComp="";
  $nomComp="";
  $lieuComp="";
  $anneeComp="";

$errorMessage="";
$successMessage="";


if($_SERVER['REQUEST_METHOD'] == 'GET'){


    if(!isset($_GET['idComp'])){
        header("location:gestionComp.php");
        exit; 
    }
    $idComp= $_GET["idComp"];

    //read the row of the selected participant from database table
     $sql= "SELECT * FROM Comp WHERE idComp='$idComp' " ;
     $result= $connection->query($sql);
     $row = $result->fetch_assoc( ); //read from database


     if(!$row){
        header("location: gestionComp.php");
        exit;
     }
    
     $nomComp = $row["nomComp"];
     $lieuComp = $row["lieuComp"];
     $anneeComp = $row["anneeComp"];

}
    else
    {    // update data of the participant
    $idComp = $_POST['idComp'];
    $nomComp = $_POST['nomComp'];
    $lieuComp = $_POST['lieuComp'];
    $anneeComp = $_POST['anneeComp'];

       // do {
        if ( empty($idComp)|| empty($nomComp)|| empty($lieuComp)|| empty($anneeComp)){
            $errorMessage = "tous les champs sont importants ";
           // break;
     }
 //   $sql = "UPDATE `participants` SET `nomPar`=\'[value-1]\',`prenomPar`=\'[value-2]\',`agePar`=18,`emailPar`=\'[value-4]\',`telPar`=8755456,`adrPar`=\'[value-6]\' WHERE 1;";

    $sql = "UPDATE `comp` SET `nomComp` = '$nomComp',`lieuComp` = '$lieuComp',`anneeComp` = '$anneeComp' WHERE idComp = '$idComp' ";
            $result = $connection->query($sql);
    if(!$result){
        $errorMessage = "invalid query : " .$connection->error ;
       // break ;
    }
    $successMessage = "Competition updated correctly";

    header("location: gestionComp.php");


}


       // }while (false);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
<?php include('headerAdmin.php');?>
    <div class="container my-5">
        <h2>Modifier Competition</h2>

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
        <input type="hidden" name="idComp" value="<?php echo $idComp; ?>">
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Nom Competition</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="nomComp" value="<?php echo $nomComp; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Lieu Competition</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="lieuComp" value="<?php echo $lieuComp; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
            <label class="col-sm-3 col-form-label">Annee Competition</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="anneeComp" value="<?php echo $anneeComp; ?>">
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
                    <a class="btn btn-outline-primary" href="gestionComp.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>