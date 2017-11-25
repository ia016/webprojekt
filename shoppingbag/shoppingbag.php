<h1>Warenkorb</h1>
<hr/>

<table class="table table-responsive table-striped">
    <th>Name</th>
    <th>Kategorie</th>
    <th>Titel</th>
    <th>Beschreibung</th>
    <th>Preis</th>
    <?php
    $sqlContent = 'SELECT p.name, c.name as category_name, p.title, p.description, p.price 
            FROM shoppingbag s, products p, categories c 
            WHERE s.productsid = p.id AND p.categoryid = c.id';
    $sqlTotalSum = 'SELECT SUM(p.price) as totalSum FROM products p, shoppingbag s WHERE s.productsid = p.id';
    $preparedContent = $pdo->prepare($sqlContent);
    $preparedSum = $pdo->prepare($sqlTotalSum);
    $preparedContent->execute();
    $preparedSum->execute();
    $products = $preparedContent->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array
    $totalSum = $preparedSum->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>".$product["name"]."</td>";
        echo "<td>".$product["category_name"]."</td>";
        echo "<td>".$product["title"]."</td>";
        echo "<td>".$product["description"]."</td>";
        echo "<td>".$product["price"]. " €"."</td>";
        echo "</tr>";
        }
        echo "<tr><td>Summe</td>/td><td align='right' colspan='4'>".$totalSum[0]["totalSum"]." €"."</td></tr>"
    ?>
</table>