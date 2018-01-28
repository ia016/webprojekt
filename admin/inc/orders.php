<h2>Bestellungen</h2>
<?php
$sql = 'SELECT * FROM orders ORDER BY id';
$prepared = $pdo->prepare($sql);
$prepared->execute();
$orders = $prepared->fetchAll(PDO::FETCH_ASSOC);

foreach($orders as $order) {

	echo "<div class=\"row\">";
    echo "<div class=\"col-12 mb-5\">";
	echo "<div class=\"card\">";
	echo "<h3 class=\"card-header\">Bestellung #".$order["id"]."</h3>";

	?>
	<div class="col-12">
		<div class="row">
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>Name</th>
						<th>Preis / Stück</th>
						<th>Menge</th>
						<th>Preis</th>
						<th>EAN</th>
					</tr>
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
		echo "<td>".number_format($product["price"], 2)."€"."</td>";
		echo "<td>".$product["amount"]."</td>";
		echo "<td>".number_format($product["total"], 2)."€"."</td>";
		echo "<td>".$product["ean"]."</td>";
		echo "</tr>";
	}
	echo "<tr><td>Summe</td><td align='right' colspan='4'>".number_format($totalSum[0]["totalSum"], 2)." €"."</td></tr>"
	?>
		</table>
	</div>
	<div class="col-5">
		<div class="row">
			<h4 class="col-12">Versandadresse</h4>
			<div class="col-12">
				<p><?=$order["dist_name"];?></p>
				<p><?=$order["dist_address"];?></p>
				<p><?=$order["dist_postcode"];?><?=$order["dist_city"];?></p>
				<p><?=$order["dist_email"];?></p>
				<p><?=$order["dist_mobil"];?></p>
			</div>
		</div>
	</div>
	<div class="col-5">
		<div class="row">
			<h4 class="col-12">Rechnungsadresse</h4>
			<div class="col-12">
				<p><?=$order["bill_name"];?></p>
				<p><?=$order["bill_address"];?></p>
				<p><?=$order["bill_postcode"];?><?=$order["bill_city"];?></p>
				<p><?=$order["bill_email"];?></p>
				<p><?=$order["bill_mobil"];?></p>
			</div>
		</div>
	</div>
    <?php
	echo "</div></div></div></div></div";
	}
?>