<?php
require('../config.php');
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$sql= "SELECT * FROM users";
$result=mysqli_query($conn, $sql);

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
    <div class="success">
        <h1>Bienvenue <?php echo $_SESSION['username']; ?> !</h1>
        <p>C'est votre espace admin. <a href='../user/index.php'>-> Espace utilisateur</a></p>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</t>
                    <th>Role</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                    <td data-label="Username : "> <?php echo $row['username']; ?></td>
                    <td data-label="Email : "> <?php echo $row['email']; ?></td>
                    <td data-label="Role : "> <?php echo $row['role']; ?></td>
                    <td  data-label="Options : ">
                        <a href="update_user.php?id=<?php echo $row['id']; ?>">Update user</a></br>
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete user</a>
                    </td>
                </tr>
            </tbody>
            <?php
                }
            ?>
        </table>
        <div class="">
            <a href="add_user.php">Add user</a> |
            <a href="../user/logout.php">Déconnexion</a>
        </div>
    </div>
</body>

</html>