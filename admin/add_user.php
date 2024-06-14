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

    if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['role'], $_REQUEST['password'])) {
        // récupérer le nom d'utilisateur 
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        // récupérer l'email 
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn, $email);
        // récupérer le mot de passe 
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // récupérer le role (user | admin)
        $role = stripslashes($_REQUEST['role']);
        $role = mysqli_real_escape_string($conn, $role);

        $query = "INSERT into `users` (username, email, role, password)
          VALUES ('$username', '$email', '$role', '" . hash('sha256', $password) . "')";
        $res = mysqli_query($conn, $query);

        if ($res) {
            echo "<div class='success'>
             <h3>L'utilisateur a été créée avec succés.</h3>
             <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
       </div>";
        }
    } else {
        ?>
        <form class="box" action="" method="post">
            <h1 class="box-logo box-title">
                <a href="home.php">Monsupercrud</a>
            </h1>
            <h1 class="box-title">Add user</h1>
            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />

            <input type="email" class="box-input" name="email" placeholder="Email" required />

            <div>
                <select class="box-input" name="role" id="role">
                    <option value="" disabled selected>Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <input type="password" class="box-input" name="password" placeholder="Mot de passe" minlength="8" required />

            <input type="submit" name="submit" value="+ Add" class="box-button" />
        </form>
    <?php } ?>
</body>

</html>