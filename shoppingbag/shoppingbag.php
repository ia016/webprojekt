<h1>Warenkorb</h1>
<hr/>

<?php
    $sqlContent = 'SELECT s.id as shoppingbag_id, p.name, c.name as category_name, p.id as product_id, p.title, p.description, p.price, s.amount, p.price * s.amount as total
            FROM shoppingbag s, products p, categories c 
            WHERE s.productsid = p.id AND p.categoryid = c.id AND s.sessionid = "'.$sessionId.'"';
    $sqlTotalSum = 'SELECT SUM(p.price * s.amount) as totalSum FROM products p, shoppingbag s WHERE s.productsid = p.id AND s.sessionid = "'.$sessionId.'"';
    $preparedContent = $pdo->prepare($sqlContent);
    $preparedSum = $pdo->prepare($sqlTotalSum);
    $preparedContent->execute();
    $preparedSum->execute();
    $products = $preparedContent->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array
    $totalSum = $preparedSum->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($products)) {
?>
<div class="row justify-content-between">
    <div class="table-responsive">
        <table class="table table-striped">
            <th>Name</th>
            <th>Categroy</th>
            <th>Title</th>
            <th>Description</th>
            <th style="min-width: 130px;">Preis / Stück</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Remove</th>
            <?php
            foreach ($products as $product) {
                echo "<tr>";
                echo "<td><a href=\"?product=".$product["product_id"]."\">".$product["name"]."</a></td>";
                echo "<td>".$product["category_name"]."</td>";
                echo "<td>".$product["title"]."</td>";
                echo "<td>".$product["description"]."</td>";
                echo "<td class='text-center'>".number_format($product["price"], 2)."€"."</td>";
                echo "<td>";
                echo "<form action=\"?changeamount=".$product["product_id"]."\" method=\"post\">";
                echo "<input type=\"number\" name=\"amount\" value=\"".$product["amount"]."\" />";
                echo "</form>";
                echo "</td>";
                echo "<td>".number_format($product["total"], 2)."€"."</td>";
                echo "<td><a href=\"?removefromshoppingbag=".$product["shoppingbag_id"]."\">entfernen</a></td>";
                echo "</tr>";
                }
                echo "<tr><td>Summe</td><td align='right' colspan='6'>".number_format($totalSum[0]["totalSum"], 2)." €"."</td><td></td></tr>"
            ?>
        </table>
    </div>
</div>
<div class="row justify-content-end">
    <a href="index.php?page=order">
        <button class="btn btn-primary col-auto" type="button">
            ORDER
        </button>
    </a>
</div>

<?php
    } else {
        echo "<h3>Shopping bag is empty</h3>";
    }
?>