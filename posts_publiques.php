<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>all posts</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include 'header.php'; ?>
<?php 

try {
    $db = new PDO("mysql:host=localhost;dbname=Competition","root","");
    //Définir le mode d'erreur de PDO à Exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<!-- view all posts section starts  -->

<section class="all-posts">

   <div class="heading"><h1>all posts</h1></div>

   <div class="box-container">

   <?php
      $select_posts = $db->prepare("SELECT * FROM `participant`");
      $select_posts->execute();
      if($select_posts->rowCount() > 0){
         while($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)){

         $post_id = $fetch_post['idPar'];

         $count_reviews = $db->prepare("SELECT * FROM `review` WHERE idPar = ?");
         $count_reviews->execute([$post_id]);
         $total_reviews = $count_reviews->rowCount();
         $note_post=$fetch_post['note'];
   ?>
   <div class="box">
      <img src="uploaded_files1/<?= $fetch_post['image']; ?>" alt="" class="image">
      <h3 class="title"><?= $fetch_post['titre']; ?></h3>
      <p class="total-reviews"><i class="fas fa-star"></i> <span><?= $note_post; ?></span></p>
      <a href="view_post_publique.php?idPar=<?= $post_id; ?>" class="inline-btn">view post</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no posts added yet!</p>';
   }
   ?>

   </div>

</section>

<!-- view all posts section ends -->

</body>
</html>
