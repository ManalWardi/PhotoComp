<!DOCTYPE html>
<html>
<head>
  <title>LOGIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <style>
  .custom-btn {
    background-color: #16a085;
    color: white;
  }
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
<div class="background-image">
<br>
<br>
<div class="container mt-4">

  <h1>Login </h1>
  <div class="container mt-4">
  <p>
  <form action="verification.php" method="POST"></p>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
    </div>
    <div class="form-group">
                 <label class="col-sm-3 col-form-label">Role</label>
                 <div class="col-sm-6">
                 <select name="role" class="form-control" value="<?php echo $role; ?>">
                      <option>Admin</option>
                       <option>Jury</option> 
                 </select> 
                 </div>
            </div>
    <button type="submit" class="btn btn-primary custom-btn">Submit</button>
    <a href="principalUser.php" class="btn btn-primary custom-btn">Retour au site d acceuil</a>

  </form>
</div>
  </div>
  </div>





</body>
</html>