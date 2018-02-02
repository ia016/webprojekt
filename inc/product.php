<?php
    $sql = 'SELECT * FROM products WHERE products.id = ?'; //welche Variable wird bei dem ? hier eingesetzt?
    $prepared = $pdo->prepare($sql);

    $prepared->execute(array(
        $_GET["product"] //aus der Index Datei oder woher kommt das Product?
    ));
    $product = $prepared->fetch(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array -> Wert wird Key zugeteilt
?>
<div class="row justify-content-between" id="product-details"> <!-- Class ist in bootstrap vordefiniert ->
                                                               Horizontale Ausrichtung Ganz links, mitte ganz rechts-->
    <div class="col-12">
        <h1 class="h3"><?=$product["name"];?></h1>
    </div>
    <div class="col-12 col-md-6">
        <img class="w-100" src="<?="images/products/".$product["image"];?>">
    </div>
    <div class="col-12 col-md-6 align-self-center">
        <div class="row justify-content-start">
            <h2 class="col-12 h6"><?=$product["title"];?></h2>  <!-- stellt den Product title aus der Datenbank dar  -->
            <p class="col-12"><?=$product["description"];?></p>
            <strong class="col-12"><?=$product["price"];?>€</strong> <!-- Teil eines Fließtextes als stark betont, wirken wie kleine Überschriften  -->
            <?php if ($product["details"] != "") : ?> <!-- != -> ungleich -> wenn details nicht leer sind -->
                <h2 class="mt-3 col-12 h6">DETAILS</h2>
                <p class="col-12">
                <ul>
                    <?php
                    $details = explode(", ", $product["details"]); // teilt einen String anhand einer Zeichenkette aus
                    // delimiter -> Die Begrenzungszeichenkette -> In diesem Fall mit Komma
                    foreach ($details AS $detail) {
                        echo "<li>".$detail."</li>";
                    }
                    ?>
                </ul>
                </p>
            <?php endif; ?> <!-- Alternative Schreibweise für if-Statement , dadurch kann auf echo verzichtet werden und HTML wird direkt ausgegeben-->
            <p class="col-12">
            <?php
            $sql = 'SELECT * FROM ratings WHERE productid = ?';
            $prepared = $pdo->prepare($sql);
            $prepared->execute(array(
                $product["id"] // Productid wird ins Platzhalter ? übergeben??
            ));
            $ratings = $prepared->fetchAll(PDO::FETCH_ASSOC);

            $ratingCounter = 0; //keine ahnung was hier abgeht SOS :-D
            $stars = 0;
            foreach($ratings as $rating) {
                $stars = $stars + $rating["rating"];
                $ratingCounter = $ratingCounter + 1;
            }
            if ($ratingCounter > 0) {
                $rating = round($stars / $ratingCounter);
                echo "Rating: ";
                for ($i = 0; $i < $rating; $i++) {
                    echo "<img src=\"images/star.png\" />";
                }
            } else {
                echo "Rating: product is not yet rated";
            }
            ?>
            </p>
        </div>
    </div>
    <div class="col-12 col-md-6 offset-md-6 align-self-end">
        <form method="post" action="?action=add-to-bag&productid=<?=$product["id"];?>">
            <div class="input-group">
                <input class="form-control" type="number" name="amount" min="1" value="1" />
                <div class="input-group-append">
                    <input type="submit" class="btn btn-primary" value="add to cart" />
                </div>
            </div>
        </form>
    </div>
    <div>

        <h4>Ratings</h4>

        <form action="./?page=addcomment&id=<?=$product["id"];?>" method="post">
            Name:<br />
            <input type="text" name="name" /><br />
            Rating:<br />
            <select name="rating">
                <option>Please select</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select><br />
            Comment:<br />
            <textarea name="comment"></textarea><br />
            <input type="submit" value="send" />
        </form>

        <?php
        $sql = 'SELECT * FROM ratings WHERE productid = ?';
        $prepared = $pdo->prepare($sql);
        $prepared->execute(array(
            $product["id"]
        ));
        $ratings = $prepared->fetchAll(PDO::FETCH_ASSOC);

        foreach($ratings as $rating) {
            echo "<h4>";
            echo $rating["name"];
            echo " ";
            for ($i = 0; $i < $rating["rating"]; $i++) {
                echo "<img src=\"images/star.png\" />";
            }
            echo "</h4>";
            echo "<p>";
            echo $rating["comment"];
            echo "</p>";
        }
        ?>
    </div>
</div>