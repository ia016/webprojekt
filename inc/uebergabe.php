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



// in Warenkorb hinzufügen
if (isset($_GET["action"])) {

    if ($_GET["action"] == "add-to-bag") {

        $amount = $_POST["amount"];
        $productId = $_GET["productid"];

        // Ist Produkt schon in Warenkorb? Anzahl erhöhen
        $statement = $pdo->prepare("SELECT * FROM shoppingbag WHERE productsid = ? AND sessionid = ?");
        $statement->execute(
            array($productId, $sessionId)
        ) or die(print_r($statement->errorInfo(), true));
        $shoppingBag = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($shoppingBag)) {
            $statement = $pdo->prepare("INSERT INTO shoppingbag (productsid, amount, sessionid) VALUES (?, ?, ?)");
            $statement->execute(
                array($productId, $amount, $sessionId)
            ) or die(print_r($statement->errorInfo(), true));
        } else {
            // Anzahl erhöhen
            $amountNew = $shoppingBag["amount"] + $amount;

            $statement = $pdo->prepare("UPDATE shoppingbag SET amount = ? WHERE id = ?");
            $statement->execute(
                array($amountNew, $shoppingBag["id"])
            ) or die(print_r($statement->errorInfo(), true));
        }

        header("Location: ?page=shoppingbag");
    }

}

// Artikel aus Warenkorb löschen
if (isset($_GET["removefromshoppingbag"])) {
    // Produkt speichern
    $statement = $pdo->prepare("DELETE FROM shoppingbag WHERE id = ? AND sessionid = ?");
    $statement->execute(
        array($_GET["removefromshoppingbag"], session_id())
    ) or die(print_r($statement->errorInfo(), true));

    echo "ok";

    header("Location: ?page=shoppingbag");
}


// Anzahl erhöhen
if (isset($_GET["changeamount"])) {

    echo "anz";
    $product_id = $_GET["changeamount"];
    $amount = $_POST["amount"];

    $statement = $pdo->prepare("UPDATE shoppingbag SET amount = ? WHERE productsid = ? AND sessionid = ?");
    $statement->execute(
        array($amount, $product_id, $sessionId)
    ) or die(print_r($statement->errorInfo(), true));

    header("Location: ?page=shoppingbag");
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

// Produktbewertungen speichern
if(isset($_GET["page"]) && $_GET["page"] == "addcomment") {

    $id = $_GET["id"];
    $name = $_POST["name"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];

    $statement = $pdo->prepare("INSERT INTO ratings (productid, name, rating, comment) VALUES (?, ?, ?, ?)");
    $statement->execute(
        array($id, $name, $rating, $comment)
    ) or die(print_r($statement->errorInfo(), true));

    header("Location: ./?product=".$id);
}

// Kontaktformular absenden
if(isset($_GET["page"]) && $_GET["page"] == "contactform" && !empty($_POST)) {
    header("Location: ./?page=mailsent");
}

?>