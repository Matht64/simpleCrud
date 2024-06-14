<?php
    require ('../config.php');

    $user_id = stripslashes($_GET['id']);
    $sql = "SELECT * FROM users where id = $user_id";
    $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>
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

    if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['role'])) {
        // récupérer le nom d'utilisateur 
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        // récupérer l'email 
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn, $email);
        // récupérer le role (user | admin)
        $role = stripslashes($_REQUEST['role']);
        $role = mysqli_real_escape_string($conn, $role);

        $id = $user['id'];

        $query = "UPDATE `users` set username='$username', email='$email', role='$role'
        where id = $id";
        $res = mysqli_query($conn, $query);

        if ($res) {
            echo "<div class='success'>
             <h3>L'utilisateur a été modifié avec succès.</h3>
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
            <input type="text" class="box-input" name="username" value="<?php echo $user['username']?>" required />
            <input type="email" class="box-input" name="email" value="<?php echo $user['email']?>" required />
            <div>
                <select class="box-input" name="role" id="role">
                    <option value="" disabled selected>Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Update" class="box-button" />
        </form>
    <?php } ?>
</body>

</html>