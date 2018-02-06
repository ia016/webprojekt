<?php

include("../inc/uebergabe.php");


// immer prüfen, ob der User eingeloggt ist. standardannahme: user ist nicht eingeloggt
$sql = "SELECT * FROM users WHERE session = ?";
$prepared = $pdo->prepare($sql);
$prepared->execute(array(
    session_id()
));
$user = $prepared->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $loggedin = true;
} else {
    $loggedin = false;
}


// user loggt sich ein: Form wird abgesendet (1)
if (isset($_GET['login'])) {

    // Ruft die Login Form auf mit login=1 (GET)--> Daten, die im Formular eingegeben werden, werden mit post übermittelt (2)
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
        // wenn login erfolgreich (6)
        header("Location: ./?manage=orders");
    }

}

// logout
if (isset($_GET["logout"])) {
    session_regenerate_id();
    header("Location: ./");
}




// order-seite als erstes anzeigen
if ($loggedin && isset($_GET["manage"])) {
    $manage = $_GET["manage"];
}

// Kategorien speichern
if (isset($_GET["addcategory"])) {
    $name = $_POST["name"];
    $statement = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $statement->execute(
        array($name)
    );
    header("Location: ?manage=categories");
}

// Kategorie löschen
if (isset($_GET["deletecategory"])) {
    $id = $_GET["deletecategory"];
    $statement = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $statement->execute(
        array($id)
    );
    header("Location: ?manage=categories");
}

// Kategorie zum Ändern holen
if (isset($_GET["editcategory"])) {
    $id = $_GET["editcategory"];
    $sql = "SELECT * FROM categories WHERE id = ?";
    $prepared = $pdo->prepare($sql);
    $prepared->execute(array(
        $id
    ));
    $selectedCategory = $prepared->fetch(PDO::FETCH_ASSOC);
}

// Kategorie ändern
if (isset($_GET["editcategory"]) && !empty($_POST)) {
    $name = $_POST["name"];
    $id = $_GET["editcategory"];
    $statement = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $statement->execute(
        array($name, $id)
    );
    header("Location: ?manage=categories");
}

// Kategorien holen (fürs Hinzufügen von Produkten)
$sql = "SELECT * FROM categories";
$prepared = $pdo->prepare($sql);
$prepared->execute(array());
$allCategories = $prepared->fetchAll(PDO::FETCH_ASSOC);

// Produkt speichern
if (isset($_GET["addproduct"])) {
    $name = $_POST["name"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $categoryid = $_POST["category"];
    $details = $_POST["details"];
    $price = $_POST["price"];
    $ean = $_POST["ean"];

    // Bild hochladen
    if ($_FILES["foto"]["name"]  !== "") {
        move_uploaded_file($_FILES['foto']['tmp_name'], './../images/products/'.$_FILES["foto"]["name"]);
        $foto = $_FILES["foto"]["name"];
    } else if ($foto == "") {
        // Wenn kein Image gesetzt, dann Platzhalter
        $foto = "../images/products/noimage.png";
    }

    // Produkt speichern
    $sql = "INSERT INTO products (name, title, description, categoryid, details, price, image, ean) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        array($name, $title, $description, $categoryid, $details, $price, $foto, $ean)
    );
    header("Location: ?manage=products");
}

// Produkt löschen
if (isset($_GET["deleteproduct"])) {
    $id = $_GET["deleteproduct"];
    $statement = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $statement->execute(
        array($id)
    );
    header("Location: ?manage=products");
}

// Produkt zum editieren holen
if (isset($_GET["product"])) {
    $id = $_GET["product"];
    $sql = "SELECT * FROM products WHERE id = ?";
    $prepared = $pdo->prepare($sql);
    $prepared->execute(array(
        $id
    ));
    $selectedProduct = $prepared->fetch(PDO::FETCH_ASSOC);
}

// Produkt editieren
if (isset($_GET["editproduct"]) && !empty($_POST)) {
    $name = $_POST["name"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $categoryid = $_POST["category"];
    $details = $_POST["details"];
    $price = $_POST["price"];
    $ean = $_POST["ean"];

    // bild hochladen
    $foto = "";
    if ($_FILES["foto"]["name"] !== "") {
        move_uploaded_file($_FILES['foto']['tmp_name'],  "./../images/products/".$_FILES["foto"]["name"]);
        $foto = $_FILES["foto"]["name"];
    } else {
        $foto = $selectedProduct["image"];
    }

    // Wenn kein Image gesetzt, dann Platzhalter
    if ($foto == "") {
        $foto = "noimage.PNG";
    }

    // Produkt speichern
    $statement = $pdo->prepare("UPDATE products SET name = ?, title = ?, description = ?, categoryid = ?, details = ?, price = ?, image = ?, ean = ? WHERE id = ?");
    $statement->execute(
        array($name, $title, $description, $categoryid, $details, $price, $foto, $ean, $selectedProduct["id"])
    );
    header("Location: ?manage=products");
}

// Benutzer speichern
if (isset($_GET["adduser"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $statement = $pdo->prepare("INSERT INTO users (name, password) VALUES (?, md5(?))");
    $statement->execute(
        array($name, $password)
    );
    header("Location: ?manage=users");
}

// Benutzer zum Ändern holen
if (isset($_GET["user"])) {
    $id = $_GET["user"];
    $sql = "SELECT * FROM users WHERE id = ?";
    $prepared = $pdo->prepare($sql);
    $prepared->execute(array(
        $id
    ));
    $selectedUser = $prepared->fetch(PDO::FETCH_ASSOC);
}

// Benutzerdaten ändern
if (isset($_GET["edituser"]) && !empty($_POST)) {

    $id = $_GET["edituser"]; //edituser = userid
    $name = $_POST["name"];
    $password = $_POST["password"];

    $sql = "UPDATE users SET name = ? WHERE id = ?";
    $prepared = $pdo->prepare($sql);
    $prepared->execute(array(
        $name, $id
    ));

    // neues Passwort eingegeben? Dann ändern
    if (!empty($password)) {
        $sql = "UPDATE users SET password = md5(?) WHERE id = ?";
        $prepared = $pdo->prepare($sql);
        $prepared->execute(array(
            $password, $id
        ));
    }

    header("Location: ?manage=users");
}

// Benutzer löschen
if (isset($_GET["deleteuser"])) { //deleteuser ist die id die über die URL übergeben wird

    $id = $_GET["deleteuser"];

    $sql = "DELETE FROM users WHERE id = ?";
    $prepared = $pdo->prepare($sql);
    $prepared->execute(array(
        $id
    ));

    header("Location: ?manage=users"); // damit deleteuser nicht mehr in der URL steht -> schlecht beim Aktualisieren etc.
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

<?php if (!$loggedin) :
    // Wenn User nicht eingeloggt ist und name/password nicht leer sind, dann errror und formular ?>
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

    <div id="main">
        <div id="navigation">
            <ul>
                <li><a href="?manage=categories">Kategorien</a></li>
                <li><a href="?manage=products">Produkte</a></li>
                <li><a href="?manage=orders">Bestellungen</a></li>
                <li><a href="?manage=users">Benutzer</a></li>
                <li><a href="?logout=1">logout (<?=$user["name"]; ?>)</a></li>
            </ul>
        </div>
        <div id="content">

            <?php if ($manage == "categories") : ?>
                <?php include("./inc/categories.php"); ?>
            <?php elseif ($manage == "addcategory") : ?>
                <?php include("./inc/category_add.php"); ?>
            <?php elseif ($manage == "editcategory") : ?>
                <?php include("./inc/category_edit.php"); ?>
            <?php elseif ($manage == "products") : ?>
                <?php include("./inc/products.php"); ?>
            <?php elseif ($manage == "addproduct") : ?>
                <?php include("./inc/product_add.php"); ?>
            <?php elseif ($manage == "editproduct") : ?>
                <?php include("./inc/product_edit.php"); ?>
            <?php elseif ($manage == "orders") : ?>
                <?php include("./inc/orders.php"); ?>
            <?php elseif ($manage == "users") : ?>
                <?php include("./inc/users.php"); ?>
            <?php elseif ($manage == "adduser") : ?>
                <?php include("./inc/user_add.php"); ?>
            <?php elseif ($manage == "edituser") : ?>
                <?php include("./inc/user_edit.php"); ?>
            <?php endif; ?>

        </div>
    </div>


<?php endif; ?>


</body>
</html>
