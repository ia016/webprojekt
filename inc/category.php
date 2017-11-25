<?php

$sql = 'SELECT * FROM products WHERE categoryid = ? ORDER BY id';
$prepared = $pdo->prepare($sql);

$prepared->execute(array(
    $_GET["category"]
));
$products = $prepared->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array

echo "<ul>";
foreach ($products as $product) {
    echo "<li><a href=\"?product=" . $product["id"] . "\">" . $product["name"] . "</a></li>";
}
echo "</ul>";