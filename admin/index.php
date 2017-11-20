<?php
    include("../inc/uebergabe.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../style/style.css" rel="stylesheet">
    <?php
    include("../inc/js.php");
    ?>

    <meta charset="UTF-8">
    <title>my lovely home</title>
</head>
<body>
<?php
include "../inc/header.php";
?>
<div class="container">




    <?php

        if(isset($_GET["page"])){

            if($_GET["page"] == "login"){

                $login = $_POST['login'];
                $password = $_POST['password'];

                //Überprüfe ob Benutzer gleich in der Datenbank

                $statement = $pdo->prepare("SELECT password FROM user WHERE name=$login");
                $result = $statement->execute(array('login' => $login));
                $user = $statement->fetch();
                //Überprüfung des Passworts
                echo "geht".$user['password'];

                /*
                $password_md5 = md5($password.md5($password));

                if($password_md5 == $user['password']){
                    //Login erfolgreich
                }
                */

                /*if ($user !== false && password_verify($passwort, $user['passwort'])) {
                    $_SESSION['userid'] = $user['id'];
                    $_SESSION['username'] = $user['name'];
                    echo ('Login erfolgreich. Weiter zu deinem <a href="index.php?page=account&action=profil">Profil</a>');
                } else {
                    $errorMessage = "E-Mail oder Passwort war ungültig<br>";
                    echo $errorMessage;
                }*/



            }

        }

    ?>




    <h1>Admin Login</h1>
    <form id="login" action="index.php?page=login" method="post">
        <input id="login-name" name="login" type="text">
        <input id="login-password" name="password" type="password">
        <input type="submit" value="Send">
    </form>
</div>
<?php
include "../inc/footer.php";
?>

</body>
</html>
