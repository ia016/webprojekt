<?php


try {
    $pdo = new PDO('mysql:dbhost=localhost; dbname=u-ia016', 'ia016', 'aShouj5To8');
}

catch (PDOException $p) {
    echo ("Fehler beim Aufbau der Datenverbindung.");
    print_r($p);
    die();
}



if (isset($_GET["action"])) {

    if ($_GET["action"] == "add-to-bag") {

        $amount = $_POST["amount"];
        $productId = $_GET["productid"];

        session_start();
        $sessionId = session_id();

        $statement = $pdo->prepare("INSERT INTO shoppingbag (productsid, amount, sessionid) VALUES (?, ?, ?)");
        $statement->execute(
            array($productId, $amount, $sessionId)
        );
        header("Location: ?page=shoppingbag");

    }

}

?>