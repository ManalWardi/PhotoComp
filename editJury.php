<?php

$servername= "localhost";
$username= "root";
$password="";
$database="Competition";

  //Create Connexion
  $connection = new mysqli($servername, $username , $password,$database );





$nomJury="";
$prenomJury="";
$emailJury="";
$username="";
$idComp="";

$errorMessage="";
$successMessage="";


if($_SERVER['REQUEST_METHOD'] == 'GET'){


    if(!isset($_GET['idJury'])){
        header("location:gestionJury.php");
        exit; 
    }
    $idJury = $_GET["idJury"];

    //read the row of the selected participant from database table
     $sql= "SELECT * FROM jury WHERE idJury=$idJury " ;
     $result= $connection->query($sql);
     $row = $result->fetch_assoc( ); //read from database


     if(!$row){
        header("location: gestionJury.php");
        exit;
     }
     $nomJury = $row["nomJury"];
     $prenomJury = $row["prenomJury"];
     $emailJury = $row["emailJury"];
     $username = $row["username"];
     $idComp = $row["idComp"];


}
    else
    {    // update data of the participant
    $idJury = $_POST['idJury'];
    $nomJury = $_POST['nomJury'];
    $prenomJury = $_POST['prenomJury'];
    $emailJury = $_POST['emailJury'];
    $username = $_POST['username'];
    $idComp = $_POST['idComp'];

       // do {
        if ( empty($idJury)|| empty($nomJury)|| empty($prenomJury)|| empty($emailJury)|| empty($username)|| empty($idComp)){
            $errorMessage = "tous les champs sont importants ";
           // break;
     }
 //   $sql = "UPDATE `participants` SET `nomPar`=\'[value-1]\',`prenomPar`=\'[value-2]\',`agePar`=18,`emailPar`=\'[value-4]\',`telPar`=8755456,`adrPar`=\'[value-6]\' WHERE 1;";

    $sql = "UPDATE `jury` SET `nomJury` = '$nomJury',`prenomJury`= '$prenomJury',`emailJury`= '$emailJury',`username`= '$username',`idComp`= '$idComp' WHERE idJury = $idJury ";
            $result = $connection->query($sql);
    if(!$result){
        $errorMessage = "invalid query : " .$connection->error ;
       // break ;
    }
    $successMessage = "Jury updated correctly";

    header("location: gestionJury.php");


}


       // }while (false);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurys</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
<?php include('headerAdmin.php');?>
    <div class="container my-5">
        <h2>Modifier Jury</h2>

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
            <input type="hidden" name="idJury" value="<?php echo $idJury; ?>">
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Nom Jury</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="nomJury" value="<?php echo $nomJury; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Prenom Jury</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenomJury" value="<?php echo $prenomJury; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Email Jury</label>
                 <div class="col-sm-6">
                    <input type="email" class="form-control" name="emailJury" value="<?php echo $emailJury; ?>">
                 </div>
            </div>
            <div class="form-group col-6">
         <label for="competition">Username :</label>
         <div class="col-sm-6">
        <select id="username" name="username">
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
           $sql= "SELECT * FROM Comptes";
           $result= $connection->query($sql);

           if (!$result){
                die("invalid query:".$connection->error);
           }
           // read data of each row 
           while($row = $result->fetch_assoc()){
            echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
           }
                    
            ?>
        </select>
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
                    <a class="btn btn-outline-primary" href="gestionJury.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>