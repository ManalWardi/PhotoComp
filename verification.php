<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']))
{
    try{
        $pdo= new PDO ("mysql:host=localhost;dbname=Competition","root","");
    }catch(Exception $e){
        die('Erreur de connexion :'.$e->getMessage());
    }
 
 $username=$_POST['username'];
 $password=$_POST['password'];
 $role=$_POST['role'];
 $requete = "SELECT * FROM Comptes where 
 username = '".$username."' and password = '".$password."' and role= '".$role."'";
 $resultat=$pdo->query($requete);


 if ( $reponse =$resultat->fetch()){
    if($role=='Admin'){
    $_SESSION['username']=$username;
    header('location:principalAdmin.php');}
    if($role=='Jury'){
        $_SESSION['username']=$username;
        header('location:principalJury.php');}

}
else {
    $_SESSION['erreurLogin']="<strong>Erreur!! </strong> Login ou mot de passe incorrecte ! ";
        header('location:login.php?erreur=connexionimpossible');
}
}

?>