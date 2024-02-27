<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
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
<?php include('header.php');?>

  <div class="background-image">
    <div class="container mt-4">
    <h1>Bienvenue à PhotoComp</h1>
    
  <p>Nous sommes ravis de vous accueillir à notre compétition annuelle de photographie, où nous célébrons l'art de capturer des moments précieux à travers l'objectif de la caméra.</p>
  <p>Que vous soyez un photographe professionnel chevronné ou un amateur passionné, cette compétition est l'occasion parfaite de montrer votre talent et votre créativité dans le monde de la photographie.</p>
  <p>Nous invitons tous les participants à soumettre leurs meilleures œuvres, qu'il s'agisse de paysages magnifiques, de portraits captivants, d'instants fugaces ou de compositions artistiques uniques.</p>
  <p>Nos juges expérimentés évalueront chaque photo avec soin, en tenant compte de la composition, de l'éclairage, de la perspective, de l'émotion et de l'originalité. Les meilleures œuvres seront récompensées lors de notre cérémonie de remise des prix.</p>
  <p>Rejoignez-nous pour cette aventure visuelle extraordinaire et laissez votre talent briller dans le monde de la photographie. Nous avons hâte de voir vos clichés incroyables et de célébrer votre passion pour cet art captivant.</p>
  </div>
  </div>