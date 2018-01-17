<h1>Warenkorb</h1>
<hr/>

<div class="row justify-content-between">
    <table class="table table-responsive table-striped">
        <th>Name</th>
        <th>Kategorie</th>
        <th>Titel</th>
        <th>Beschreibung</th>
        <th style="min-width: 130px;">Preis / Stück</th>
        <th>Menge</th>
        <th>Preis</th>
        <?php
        $sqlContent = 'SELECT p.name, c.name as category_name, p.title, p.description, p.price, s.amount, p.price * s.amount as total
                FROM shoppingbag s, products p, categories c 
                WHERE s.productsid = p.id AND p.categoryid = c.id AND s.sessionid = "'.$sessionId.'"';
        $sqlTotalSum = 'SELECT SUM(p.price * s.amount) as totalSum FROM products p, shoppingbag s WHERE s.productsid = p.id AND s.sessionid = "'.$sessionId.'"';
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
            echo "<td class='text-center'>".money_format('%.2n', $product["price"])."€"."</td>";
            echo "<td>".$product["amount"]."</td>";
            echo "<td>".money_format('%.2n', $product["total"])."€"."</td>";
            echo "</tr>";
            }
            echo "<tr><td>Summe</td><td align='right' colspan='6'>".money_format('%.2n', $totalSum[0]["totalSum"])." €"."</td></tr>"
        ?>
    </table>
</div>
<div class="row justify-content-end">
    <a href="index.php?page=order">
        <button class="btn btn-primary col-auto" type="button">
            ORDER
        </button>
    </a>
</div>

