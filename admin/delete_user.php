<?php
require('../config.php');
session_start();

$user_id=stripslashes($_GET['id']);
$sql="DELETE FROM users where id = $user_id";
if(mysqli_query($conn, $sql)){
    echo "<div class='success'>
             <h3>L'utilisateur a été supprimé avec succès.</h3>
             <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
        </div>";
    header("Location:home.php?message=DeleteSucces");
}else{
    header("Location:home.php?message=DeleteFailed");
}
exit();
?>
