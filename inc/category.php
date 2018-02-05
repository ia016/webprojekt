<?php

    $sql = "SELECT c.name as category, p.id, p.name, p.image, p.price FROM products p, categories c WHERE p.categoryid = ? AND p.categoryid = c.id";
    $prepared = $pdo->prepare($sql);

    $prepared->execute(array(
        $_GET["category"]
    ));
    $products = $prepared->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array

    echo "<div class=\"row justify-content-center\">";
    echo "<div class=\"col-12\">";
    echo "<div class=\"category-header\">";
    echo "<h2 class=\"text-uppercase\">".$products[0]["category"]."</h2>"; //von product 0 die Kategorie, da ich immer ein P 0 hab
    echo "</div></div>";

    foreach ($products as $product) {
        echo "<div class=\"new-release mt-4 col-12 col-sm-6 col-lg-3\">"; //new-release - kein Bootstrap
        echo "<a href=\"index.php?product=".$product["id"]."\">"; // Produkt wird auf der Seite verlinkt
        echo "<div class=\"card img-container\">";
        echo "<div class=\"overlay\"><div>Show</div></div>";
        echo "<img class=\"card-img-top\" width=\"100%\" src=\"images/products/".$product["image"]."\">";
        echo "<div class=\"card-body\"><h5>".$product["name"]."</h5>";
        echo "<p class=\"text-muted\">".money_format("%.2n", $product["price"])."€"."</p>";
        echo "</div></div></a></div>";
    }
    echo "</div>";
?>
