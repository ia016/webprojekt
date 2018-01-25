<h2>Bestellungen</h2>
                <?php
                $sql = 'SELECT * FROM orders ORDER BY id';
                $prepared = $pdo->prepare($sql);
                $prepared->execute();
                $orders = $prepared->fetchAll(PDO::FETCH_ASSOC);

                foreach($orders as $order) {

                    echo "<h3>Bestellung #".$order["id"]."</h3>";

                    ?>
                    <h4>Artikel</h4>
                    <table class="table table-responsive table-striped">
                    <th>Name</th>
                    <th style="min-width: 130px;">Preis / Stück</th>
                    <th>Menge</th>
                    <th>Preis</th>
                    <th>EAN</th>
                    <?php
                    $sqlContent = 'SELECT s.id as shoppingbag_id, p.name, c.name as category_name, p.id as product_id, p.title, p.description, p.price, s.amount, p.price * s.amount as total, p.ean AS ean
                            FROM shoppingbag s, products p, categories c 
                            WHERE s.productsid = p.id AND p.categoryid = c.id AND s.sessionid = "'.$order["sessionid"].'"';
                    $sqlTotalSum = 'SELECT SUM(p.price * s.amount) as totalSum FROM products p, shoppingbag s WHERE s.productsid = p.id AND s.sessionid = "'.$order["sessionid"].'"';
                    $preparedContent = $pdo->prepare($sqlContent);
                    $preparedSum = $pdo->prepare($sqlTotalSum);
                    $preparedContent->execute();
                    $preparedSum->execute();
                    $products = $preparedContent->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array
                    $totalSum = $preparedSum->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td>".$product["name"]."</td>";
                        echo "<td class='text-center'>".number_format($product["price"], 2)."€"."</td>";
                        echo "<td>".$product["amount"]."</td>";
                        echo "<td>".number_format($product["total"], 2)."€"."</td>";
                        echo "<td>";
                        echo $product["ean"];
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "<tr><td>Summe</td><td align='right' colspan='6'>".number_format($totalSum[0]["totalSum"], 2)." €"."</td><td></td></tr>"
                    ?>
                </table>
                <h4>Versandadresse</h4>
                <div>
                    <?=$order["dist_name"];?><br />
                    <?=$order["dist_address"];?><br />
                    <?=$order["dist_postcode"];?><?=$order["dist_city"];?><br />
                    <?=$order["dist_email"];?><br />
                    <?=$order["dist_mobil"];?><br />
                </div>
                <div>

                <h4>Rechnungsadresse</h4>
                <div>
                    <?=$order["bill_name"];?><br />
                    <?=$order["bill_address"];?><br />
                    <?=$order["bill_postcode"];?><?=$order["bill_city"];?><br />
                    <?=$order["bill_email"];?><br />
                    <?=$order["bill_mobil"];?><br />
                </div>
                <?php
                }
                ?>