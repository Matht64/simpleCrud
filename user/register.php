<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equip="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" />
</head>
<body>
    <?php
    require ('../config.php');
    if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])) {
        // récupérer le nom d'utilisateur 
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        // récupérer l'email 
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn, $email);
        // récupérer le mot de passe 
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "INSERT into `users` (username, email, role, password)
        VALUES ('$username', '$email', 'user', '" . hash('sha256', $password) . "')";
        $res = mysqli_query($conn, $query);
        if ($res) {
            echo "<div class='success'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
        }
    } else {
        ?>
        <form class="box" action="" method="post">
            <h1 class="box-logo box-title">
                <a href="index.php">Monsupercrud</a>
            </h1>
            <h1 class="box-title">S'inscrire</h1>
            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
            <input type="email" class="box-input" name="email" placeholder="Email" required />
            <input type="password" class="box-input" name="password" placeholder="Mot de passe" minlength="8" required />
            <input type="submit" name="submit" value="S'inscrire" class="box-button" />
            <p class="box-register">Déjà inscrit?
                <a href="login.php">Connectez-vous ici</a>
            </p>
        </form>
    <?php } ?>
</body>

</html>