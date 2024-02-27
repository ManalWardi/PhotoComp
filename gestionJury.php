<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurys</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>
<?php include('headerAdmin.php');?>
<div class="container mt-4">
        <h2>Listes des Jurys</h2>
</div>
<br>
        <div class="container ">
        <a class="btn btn-primary" href="createJury.php" role="button" >New Jury</a>
        <br>
        <br>
        <table class="table">
          <thead>
            <tr>
               <th>ID</th>
               <th>NOM</th>
               <th>Prenom</th>
               <th>Email</th>
               <th>Username</th>
               <th>idCompetition</th>
               <th>Action</th>

              </tr>
          </thead>
          <tbody>
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
               $sql= "SELECT * FROM Jury";
               $result= $connection->query($sql);

               if (!$result){
                    die("invalid query:".$connection->error);
               }
               // read data of each row 
               while($row = $result->fetch_assoc()){
                    echo"
                    
                    <tr>
                        <td>$row[idJury]</td>
                        <td>$row[nomJury]</td>
                        <td>$row[prenomJury]</td>
                        <td>$row[emailJury]</td>
                        <td>$row[username]</td>
                        <td>$row[idComp]</td>
                        
                             <td>
                                  <a class='btn btn-primary btn-sm' href='editJury.php?idJury=$row[idJury]'>Edit</a>
                                  <a class='btn btn-danger btn-sm' href='deleteJury.php?idJury=$row[idJury]'>Delete</a>
                              </td>
                    </tr>
                    ";
               }


               ?>


          </thead>
        </table>
            </div>
</body>
</html>