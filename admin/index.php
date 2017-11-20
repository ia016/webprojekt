<?php
    include("../inc/uebergabe.php");

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=u-ia016', 'ia016', 'aShouj5To8');

if(isset($_GET['login'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM user WHERE login = :login");
    $result = $statement->execute(array('login' => $login));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<form action="?login=1" method="post">
    Name:<br>
    <input type="email" size="40" maxlength="250" name="email"><br><br>

    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="passwort"><br>

    <input type="submit" value="Abschicken">
</form>
</body>
</html>

<!--<!DOCTYPE html>
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






     /*   if(isset($_GET["page"])){

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
