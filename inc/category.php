<?php

$sql = 'SELECT * FROM products WHERE categoryid = ? ORDER BY id';
$prepared = $pdo->prepare($sql);

$prepared->execute(array(
    $_GET["category"]
));
$products = $prepared->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array

echo "<ul>";
foreach ($products as $product) {
    echo "<li>";
    echo "<a href=\"?product=" . $product["id"] . "\">" . $product["name"] . "</a>";
    echo "<a href=\"?product=" . $product["id"] . "\"><img width=\"200\" src=\"images/products/".$product["image"]."\" /></a>";

    echo "</li>";
}
echo "</ul>";

$sql = 'SELECT * FROM productimages WHERE productid = ?';
$prepared = $pdo->prepare($sql);

$prepared->execute(array(
    $_GET["product"]
));
$images = $prepared->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array

foreach ($images AS $image) {
    echo "<li><img width=\"200\" src=\"images/products/".$image["filename"]."\" /></li>";
}

?>
