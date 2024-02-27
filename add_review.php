<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>ADD REVIEW</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
</head>
<body>
<!-- header section starts  -->
<?php include 'headerJury.php'; ?>
<?php include 'connect.php'; ?>
<!-- header section ends -->

<br>
<br>
<?php


try {
    $db = new PDO("mysql:host=localhost;dbname=Competition","root","");
    // Définir le mode d'erreur de PDO à Exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}


if (isset($_SESSION['username'])) {
   $username = $_SESSION['username'];
   
   if (isset($_GET['idPar'])) {
      $idPar = $_GET['idPar'];
   } else {
      $idPar = '';
      header('location:all_posts.php');
   }

   if (isset($_POST['submit'])) {
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $description = $_POST['description'];
      $description = filter_var($description, FILTER_SANITIZE_STRING);
      $rating = $_POST['rating'];
      $rating = filter_var($rating, FILTER_SANITIZE_STRING);
      
     /* $verify_jury = $db->prepare("SELECT * FROM `jury` WHERE username = ?");
         $verify_jury->execute([$username]);
         $fetch_jury=$verify_jury->fetch(PDO::FETCH_ASSOC);
            $idJury=$fetch_jury['idJury'];
         
  $_SESSION['idJury']=$idJury;*/
  echo $username;
 

  $sql = "SELECT idJury FROM jury WHERE username = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$username]);

  $jury = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($jury) {
      $idJury = $jury['idJury'];
      echo "idJury: " . $idJury;
  } else {
      echo "Aucun jury trouvé pour le nom d'utilisateur donné.";
  }



  /*$sqlState = $db->prepare('SELECT * FROM Jury where username = ?');
  $sqlState->execute([$username]);

  $Jurys = $sqlState->fetchAll(PDO::FETCH_ASSOC);
 
foreach($Jurys as $jury){
   $idJury=$jury['idJury'];
}
echo $idJury;

if ($verify_jury->rowCount() > 0) {
   $fetch_jury = $verify_jury->fetch(PDO::FETCH_ASSOC);
   $idJury = $fetch_jury['idJury'];
   //$_SESSION['idJury'] = $idJury;
} else {
   // Gérer le cas où aucun jury n'est trouvé pour le nom d'utilisateur spécifié
   // Par exemple, vous pouvez rediriger l'utilisateur ou afficher un message d'erreur
   $warning_msg[] = 'No jury found for the specified username.';
}*/


      if ($idJury != '') {
         $verify_review = $db->prepare("SELECT * FROM `review` WHERE idPar = ? AND idJury = ?");
         $verify_review->execute([$idPar, $idJury]);

         if ($verify_review->rowCount() > 0) {
            $warning_msg[] = 'Your review has already been added!';
         } else {
            $add_review = $db->prepare("INSERT INTO `review`  VALUES (NULL, ?, ?, ?, ?, ?)");
            $add_review->execute([$idPar, $idJury, $rating, $title, $description]);
            $success_msg[] = 'Review added!';
            // Redirection vers la page d'ajout de critique
            header('Location: add_review.php?idPar=' . $idPar);
            exit();
         }
      } 
   }
} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Review</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   


<!-- add review section starts  -->

<section class="account-form">

   <form action="" method="post">
      <h3>Post Your Review</h3>
      <p class="placeholder">Review Title <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="Enter review title" class="box">
      <p class="placeholder">Review Description</p>
      <textarea name="description" class="box" placeholder="Enter review description" maxlength="1000" cols="30" rows="10"></textarea>
      <p class="placeholder">Review Rating <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="Submit Review" name="submit" class="btn">
      <a href="view_post.php?idPar=<?= $idPar; ?>" class="option-btn">Go Back</a>
   </form>

</section>

<!-- add review section ends -->

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="script.js"></script>

<?php include 'alers.php'; ?>

</body>
</html>
