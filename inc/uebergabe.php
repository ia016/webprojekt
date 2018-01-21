<?php


try {
    $pdo = new PDO('mysql:dbhost=localhost; dbname=u-ia016', 'ia016', 'aShouj5To8');
}

catch (PDOException $p) {
    echo ("Fehler beim Aufbau der Datenverbindung.");
    print_r($p);
    die();
}

session_start();
$sessionId = session_id();

if (isset($_GET["action"])) {

    if ($_GET["action"] == "add-to-bag") {

        $amount = $_POST["amount"];
        $productId = $_GET["productid"];

        $statement = $pdo->prepare("INSERT INTO shoppingbag (productsid, amount, sessionid) VALUES (?, ?, ?)");
        $statement->execute(
            array($productId, $amount, $sessionId)
        );
        header("Location: ?page=shoppingbag");

    }

}


// warenkorb bestellen
if ($_GET["page"] == "order" && !empty($_POST)) {

    $dist_name = $_POST["dist_name"];
    $dist_address = $_POST["dist_address"];
    $dist_city = $_POST["dist_city"];
    $dist_postcode = $_POST["dist_postcode"];
    $dist_country = $_POST["dist_country"];
    $dist_email = $_POST["dist_email"];
    $dist_mobil = $_POST["dist_mobil"];
    $bill_name = $_POST["bill_name"];
    $bill_address = $_POST["bill_address"];
    $bill_city = $_POST["bill_city"];
    $bill_postcode = $_POST["bill_postcode"];
    $bill_country = $_POST["bill_country"];
    $bill_email = $_POST["bill_email"];
    $bill_mobil = $_POST["bill_mobil"];

    // Produkt speichern
    $statement = $pdo->prepare("INSERT INTO orders (sessionid, dist_name, dist_address, dist_city, dist_postcode, dist_country, dist_email, dist_mobil, bill_name, bill_address, bill_city, bill_postcode, bill_country, bill_email, bill_mobil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->execute(
        array(session_id(), $dist_name, $dist_address, $dist_city, $dist_postcode, $dist_country, $dist_email, $dist_mobil, $bill_name, $bill_address, $bill_city, $bill_postcode, $bill_country, $bill_email, $bill_mobil)
    ) or die(print_r($statement->errorInfo(), true));

    die("Danke für deine Bestellung");
}


?>