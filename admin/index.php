<?php

include("../inc/uebergabe.php");

// user loggt sich ein: Form wird abgesendet (1)
if (isset($_GET['login'])) {

    // Ruft die Login Form auf mit login=1 --> Daten, die im Formular eingegeben werden mit GET holen (2)
    $name = $_POST["name"];
    $password = $_POST['password'];

    // Prüfen, ob name und password korrekt sind (3)
    $sql = "SELECT * FROM users WHERE name = ? AND password = MD5(?)";
    $prepared = $pdo->prepare($sql);
   //Ersetze ? mit Formulardaten & führe die sql-Abfrage aus
     $prepared->execute(array(
        $name,
        $password
    ));
    $user = $prepared->fetch(PDO::FETCH_ASSOC);

    // wenn die user login daten korrekt sind/wenn es den user in der db gibt, dann wird die user session geupdated (4)
    if ($user) {
        // update der user session in der datenbank (5)
        $sql = "UPDATE users SET session = ? WHERE name = ?";
        $prepared = $pdo->prepare($sql);
        $prepared->execute(array(
            session_id(),
            $user["name"]
        ));
        // wenn login erfolgreich: rederect user (6)
        header("Location: ./");
    }

}

// logout
if (isset($_GET["logout"])) {
    session_regenerate_id();
    header("Location: ./");
}

// immer prüfen, ob der User eingeloggt ist
$loggedin = false;

$sql = "SELECT * FROM users WHERE session = ?";
$prepared = $pdo->prepare($sql);
$prepared->execute(array(
    session_id()
));
$user = $prepared->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $loggedin = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/admin.css" rel="stylesheet">
    <meta charset="UTF-8">
</head>
<body>

<h1 class="mylovelyhome"><a href="index.php">my lovely home</a></h1>
<hr/>

<?php if (!$loggedin) : ?>
<div id="login">
    <?php if (!empty($_POST)) : ?>
        <p class="error">
            Login failed. Please try again
        </p>
    <?php endif; ?>

    <form action="./?login=1" method="post">
        name:<br>
        <input type="name" size="40" maxlength="250" name="name"><br><br>

        Password:<br>
        <input type="password" size="40" maxlength="250" name="password"><br>

        <input type="submit" value="Abschicken">
    </form>
</div>

<?php else : ?>

    <a href="?logout=1">logout (<?=$user["name"]; ?>)</a>

<?php endif; ?>


</body>
</html>

