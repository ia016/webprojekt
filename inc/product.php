<?php



    $sql = 'SELECT * FROM products WHERE id = ? ORDER BY id';
    $prepared = $pdo->prepare($sql);

    $prepared->execute(array(
        $_GET["product"]
    ));
    $product = $prepared->fetch(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array

    ?>
    <h1><?=$product["name"];?></h1>
    <h2><?=$product["title"];?></h2>
    <p><?=$product["description"];?></p>
    <strong><?=$product["price"];?>€</strong>
    <?php

    $sql = 'SELECT * FROM productdetails WHERE productid = ?';
    $prepared = $pdo->prepare($sql);

    $prepared->execute(array(
        $_GET["product"]
    ));
    $details = $prepared->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array

    echo "<ul>";
    foreach ($details AS $detail) {
        echo $detail["detail"];
    }
    echo "</ul>";


    $sql = 'SELECT * FROM productimages WHERE productid = ?';
    $prepared = $pdo->prepare($sql);

    $prepared->execute(array(
        $_GET["product"]
    ));
    $images = $prepared->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array

    foreach ($images AS $image) {
        echo "<img width=\"200\" src=\"images/products/".$image["filename"]."\" />";
    }

