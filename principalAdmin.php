<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>PhotoComp</title>
  <style>
    
    .container.mt-4 {
    background-color: rgba(242, 242, 242, 0.8);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .container.mt-4 h1 {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333333;
  }

  .container.mt-4 p {
    font-size: 18px;
    line-height: 1.6;
    margin-bottom: 12px;
    color: #666666;
  }
    .background-image {
      background-image: url('gallery-9.jpg');
      background-color: rgba(0, 0, 0, 0.5); /* Couleur d'arrière-plan avec une opacité de 0,5 */
    background-blend-mode: overlay; /* Mode de fusion pour mélanger l'image et la couleur d'arrière-plan */
    background-size: cover; /* Ajuster la taille de l'image pour remplir l'élément */
    background-position: center; /* Position de l'image au centre de l'élément */
    width: 100vw; /* Largeur de l'élément égale à la largeur de la fenêtre */
    height: 100vh ; /* Hauteur de l'élément égale à la hauteur de la fenêtre moins la hauteur de l'en-tête */
    }
  </style>
</head>
 <body>
 <?php include('headerAdmin.php');?>
 <div class="background-image">
  <div class="container mt-4">
    <p>
 <!-- tester si l'utilisateur est connecté -->
 <?php
 session_start();
 if(isset($_GET['deconnexion']))
 { 
 if($_GET['deconnexion']==true)
 { 
 session_unset();
 header("location:login.php");
 }
 }
 else if($_SESSION['username'] !== ""){
 $user = $_SESSION['username'];
 // afficher un message
 echo "Bonjour $user, vous êtes connectés";
 }
 ?></p>
 
 <div class="container mt-4">
    <h1>Bienvenue sur la page de gestion de PhotoComp</h1>
    <p>Dans cette page vous pouvez gerer la competition de photographie, les participants ainsi que les jurys et leurs comptes.</p>
  </div>
 </div>
</div>

 <!-- ... Fin du code HTML ... -->
        

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </body>
</html>