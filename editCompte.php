<?php

$servername= "localhost";
$username= "root";
$password="";
$database="Competition";

  //Create Connexion
  $connection = new mysqli($servername, $username , $password,$database );


  $username="";
  $password="";
  $role="";
  $idComp="";

$errorMessage="";
$successMessage="";


if($_SERVER['REQUEST_METHOD'] == 'GET'){


    if(!isset($_GET['username'])){
        header("location:gestionCompte.php");
        exit; 
    }
    $username = $_GET["username"];

    //read the row of the selected participant from database table
     $sql= "SELECT * FROM Comptes WHERE username='$username' " ;
     $result= $connection->query($sql);
     $row = $result->fetch_assoc( ); //read from database


     if(!$row){
        header("location: gestionCompte.php");
        exit;
     }
    
     $password = $row["password"];
     $role = $row["role"];
     $idComp = $row["idComp"];


}
    else
    {    // update data of the participant
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $idComp = $_POST["idComp"];

       // do {
        if ( empty($username)|| empty($password)|| empty($role)|| empty($idComp)){
            $errorMessage = "tous les champs sont importants ";
           // break;
     }
 //   $sql = "UPDATE `participants` SET `nomPar`=\'[value-1]\',`prenomPar`=\'[value-2]\',`agePar`=18,`emailPar`=\'[value-4]\',`telPar`=8755456,`adrPar`=\'[value-6]\' WHERE 1;";

    $sql = "UPDATE `Comptes` SET `password`= '$password',`role`= '$role',`idComp`= '$idComp' WHERE username = '$username' ";
            $result = $connection->query($sql);
    if(!$result){
        $errorMessage = "invalid query : " .$connection->error ;
       // break ;
    }
    $successMessage = "Compte updated correctly";

    header("location: gestionCompte.php");


}


       // }while (false);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comptes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
<?php include('headerAdmin.php');?>
    <div class="container my-5">
        <h2>Modifier Compte</h2>

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
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Password</label>
                 <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" value="<?php echo $password; ?>">
                 </div>
            </div>
            <div class="row-mb-3">
                 <label class="col-sm-3 col-form-label">Role</label>
                 <div class="col-sm-6">
                 <select name="role" class="form-control" value="<?php echo $role; ?>">
                      <option>Admin</option>
                       <option>Jury</option> 
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
                    <a class="btn btn-outline-primary" href="gestionCompte.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>