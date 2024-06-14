<?php
// Initialiser la session
session_start();
// Détruire la session pour déconnecter l'utilisateur
session_destroy();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
header("Location: login.php");
exit();
?>