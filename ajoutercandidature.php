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

$nom = $_POST['nomPar'];
$prenom = $_POST['prenomPar'];
$email = $_POST['emailPar'];
$genre = $_POST['genrePar'];
$tel = $_POST['telPar'];
$age = $_POST['agePar'];
$titre = $_POST['titre'];

  

  $idComp=$_POST['idComp'];
  $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = $nom.'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files1/' . $rename;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'La taille de l\'image est trop grande !';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $rename = '';
    }
  
 
      
      $requete="INSERT INTO Participant (nomPar,prenomPar,agePar,genrePar,emailPar,telPar,titre,image,idComp) VALUES (?,?,?,?,?,?,?,?,?)";
      $params=array($nom,$prenom,$age,$genre,$email,$tel,$titre,$rename,$idComp);
      $resultat=$db->prepare($requete);
      $resultat->execute($params);
      ?>
      <html>
     <body>
     
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
          icon: "success",
          title: "bon travail !",
          text: " Félicitations ! Merci d'avoir soumis votre candidature ..!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
         }). then(function(result){
            window.location = "formParticipant.php";
             })
         </script>     

     </body></html>
 
