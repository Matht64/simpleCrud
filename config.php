<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud";
    //créé la connection
    $conn = mysqli_connect($host, $username, $password, $dbname);

    //vérifie si la connection s'est bien faite
    if (!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }
?>