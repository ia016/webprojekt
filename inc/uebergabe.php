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
if ($_GET["action"] == "add-to-bag") {

    $amount = $_POST["amount"];
    $productId = $_GET["productid"];

    // Ist Produkt schon in Warenkorb?
    $statement = $pdo->prepare("SELECT * FROM shoppingbag WHERE productsid = ? AND sessionid = ?");
    $statement->execute(
        array($productId, $sessionId)
    ) or die(print_r($statement->errorInfo(), true));
    $shoppingBag = $statement->fetch(PDO::FETCH_ASSOC);

    // Produkt neu hinzufügen - reingespeichert
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

// Artikel aus Warenkorb löschen
if (isset($_GET["removefromshoppingbag"])) {
    $id = $_GET["removefromshoppingbag"];
    // Produkt aus DB löschen
    $statement = $pdo->prepare("DELETE FROM shoppingbag WHERE id = ? AND sessionid = ?");
    $statement->execute(
        array($id, $sessionId)
    ) or die(print_r($statement->errorInfo(), true));


    header("Location: ?page=shoppingbag");
}


// neue Anzahl setzen im Formular
if (isset($_GET["changeamount"])) {

    $product_id = $_GET["changeamount"];
    $amount = $_POST["amount"];

    $statement = $pdo->prepare("UPDATE shoppingbag SET amount = ? WHERE productsid = ? AND sessionid = ?");
    $statement->execute(
        array($amount, $product_id, $sessionId)
    ) or die(print_r($statement->errorInfo(), true));

    header("Location: ?page=shoppingbag");
}


// Warenkorb bestellen -> irmi
if ($_GET["page"] == "order" && !empty($_POST)) {

    $dist_name = htmlentities($_POST["dist_name"]);
    $dist_address = htmlentities($_POST["dist_address"]);
    $dist_city = htmlentities($_POST["dist_city"]);
    $dist_postcode = htmlentities($_POST["dist_postcode"]);
    $dist_country = htmlentities($_POST["dist_country"]);
    $dist_email = htmlentities($_POST["dist_email"]);
    $dist_mobil = htmlentities($_POST["dist_mobil"]);
    $bill_name = htmlentities($_POST["bill_name"]);
    $bill_address = htmlentities($_POST["bill_address"]);
    $bill_city = htmlentities($_POST["bill_city"]);
    $bill_postcode = htmlentities($_POST["bill_postcode"]);
    $bill_country = htmlentities($_POST["bill_country"]);
    $bill_email = htmlentities($_POST["bill_email"]);
    $bill_mobil = htmlentities($_POST["bill_mobil"]);

    // Bestellung speichern
    $statement = $pdo->prepare("INSERT INTO orders (sessionid, dist_name, dist_address, dist_city, dist_postcode, dist_country, dist_email, dist_mobil, bill_name, bill_address, bill_city, bill_postcode, bill_country, bill_email, bill_mobil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->execute(
        array(session_id(), $dist_name, $dist_address, $dist_city, $dist_postcode, $dist_country, $dist_email, $dist_mobil, $bill_name, $bill_address, $bill_city, $bill_postcode, $bill_country, $bill_email, $bill_mobil)
    ) or die(print_r($statement->errorInfo(), true));

    // E-Mails senden
    $to = $dist_email;
    $from = "order@mylovelyhome.de";
    $subject = "Your order from mylovelyhome!";
    $message = "Hi ".$dist_name.",\n\nthank you for your order!\n\nPlease transfer the sum on the bank account DE837248742842834.\n\n";
    $header = "From: ".$from;

    // Warenkorb aus Datenbank holen (wie bei Shoppingbag)
    $sqlContent = 'SELECT s.id as shoppingbag_id, p.name, c.name as category_name, p.id as product_id, p.title, p.description, p.price, s.amount, p.price * s.amount as total
            FROM shoppingbag s, products p, categories c 
            WHERE s.productsid = p.id AND p.categoryid = c.id AND s.sessionid = "'.$sessionId.'"';
    $sqlTotalSum = 'SELECT SUM(p.price * s.amount) as totalSum FROM products p, shoppingbag s WHERE s.productsid = p.id AND s.sessionid = "'.$sessionId.'"';
    $preparedContent = $pdo->prepare($sqlContent);
    $preparedSum = $pdo->prepare($sqlTotalSum);
    $preparedContent->execute();
    $preparedSum->execute();
    $products = $preparedContent->fetchAll(PDO::FETCH_ASSOC);
    $totalSum = $preparedSum->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $message .= $product["amount"]."x ";
        $message .= $product["name"];
        $message .= " á ".$product["price"]."€, sum: ".($product["price"]*$product["amount"])."€";
        $message .= "\n";
    }

    $message .= "Sum: ".$totalSum[0]["totalSum"]."€";
    $message .= "\n\n";
    $message .= "We will ship your order soon!\n";
    $message .= "Your MLH Team\n\n";

    $message .= "www.mylovelyhome.com is a fictional offer from the fictional Mylovelyhome GmbH.\n\nOperator of the website: Mylovelyhome GmbH \nKatharinenstraße 16, 70182 Stuttgart\n\n";
    $message .= "Management: Irmak Ali, Anna-Maria Schmider, Nina Gausling\n\nResponsible for the content of this offer pursuant to § 55 sect. 2 RStV: Irmak Ali, Anna-Maria Schmider, Nina Gausling\n\nMy lovely home was created for a student project and is just a fictional company";

    mail($to, $subject, $message, $header);

    session_regenerate_id();
    header("Location: ?page=thankyouforyourorder");
}

// Produktbewertungen speichern
if(isset($_GET["page"]) && $_GET["page"] == "addcomment") {

    $productId = $_GET["id"];
    $name = htmlentities($_POST["name"]);
    $rating = htmlentities($_POST["rating"]);
    $comment = htmlentities($_POST["comment"]);

    $statement = $pdo->prepare("INSERT INTO ratings (productid, name, rating, comment) VALUES (?, ?, ?, ?)");
    $statement->execute(
        array($productId, $name, $rating, $comment)
    ) or die(print_r($statement->errorInfo(), true)); //gibt fehler an, "die" bricht ab, damit nicht zurückgeleitet wird auf Produkt

    header("Location: ./?product=".$productId);
}

// Kontaktformular absenden
if (isset($_GET["page"]) && $_GET["page"] == "contactform" && !empty($_POST)) {
    $name = htmlentities($_POST["name"]);
    $email = htmlentities($_POST["email"]);
    $subject = htmlentities($_POST["subject"]);
    $message = htmlentities($_POST["message"]);

    $to = "nina.ga.contact@gmail.com";
    $header = "From: ".$email;

    mail($to, $subject, $message, $header); //to subject und message werden erwartet, header optional
    header("Location: ./?page=mailsent"); //Browser umleiten
}

?>