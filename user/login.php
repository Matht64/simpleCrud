<!DOCrole html>
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
    session_start();

    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $_SESSION['username'] = $username;
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $query = "SELECT * FROM `users` WHERE username='$username' 
  and password='" . hash('sha256', $password) . "'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['role'] = $user['role'];
            // vérifier si l'utilisateur est un administrateur ou un utilisateur
            if ($user['role'] == 'admin') {
                header('location: ../admin/home.php');
            } else {
                header('location: index.php');
            }
        } else {
            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
    }
    ?>
    <form class="box" action="" method="post" name="login">
        <h1 class="box-logo box-title">
            <a href="index.php">Monsupercrud</a>
        </h1>
        <h1 class="box-title">Connexion</h1>
        <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
        <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        <input type="submit" value="Connexion" name="submit" class="box-button">
        <p class="box-register">Vous êtes nouveau ici?
            <a href="register.php">S'inscrire</a>
        </p>
        <?php if (!empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
    </form>
</body>

</html>