
<?php if (empty($_GET["q"])) : ?>
<h2>Search</h2>
<form action="./index.php?page=search" method="get">
    <input type="hidden" name="page" value="search" />
    <input type="text" name="q" />
    <input type="submit" value="suchen" />
</form>
<?php else : ?>

<div class="row justify-content-center">
<?php

    $q = htmlentities($_GET["q"]);
    echo "<h2>Results for ".$q."</h2>";

    $sql = "SELECT * FROM products WHERE name LIKE ? OR title  LIKE ? OR description  LIKE ? OR details  LIKE ?";
    $prepared = $pdo->prepare($sql);
    $prepared->execute(array(
        "%".$q."%", "%".$q."%", "%".$q."%", "%".$q."%"
    ));
    $products = $prepared->fetchAll(PDO::FETCH_ASSOC);

    if (empty($products)) {
        echo "<h3>No products found</h3>";
    } else {
        foreach ($products as $product) {
            echo "<div class='new-release mt-4 col-12 col-sm-6 col-lg-3'>";
            echo "<a href='index.php?product=".$product["id"]."'>";
            echo "<div class='card img-container'>";
            echO "<div class='overlay'><div>Show</div></div>";
            echo "<img class='card-img-top' width='100%' src='images/products/".$product["image"]."'>";
            echo "<div class='card-body'><h5>".$product["name"]."</h5>";
            echo "<p class='text-muted'>".number_format($product["price"], 2)."€"."</p>";
            echo "</div></div></a></div>";
        }
    }
?>
</div>

<?php endif; ?>
