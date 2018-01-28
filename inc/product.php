<?php
    $sql = 'SELECT * FROM products WHERE products.id = ?';
    $prepared = $pdo->prepare($sql);

    $prepared->execute(array(
        $_GET["product"]
    ));
    $product = $prepared->fetch(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array
?>
<div class="row justify-content-between" id="product-details">
    <div class="col-12">
        <h1 class="h3"><?=$product["name"];?></h1>
    </div>
    <div class="col-12 col-md-6">
        <img class="w-100" src="<?="images/products/".$product["image"];?>">
    </div>
    <div class="col-12 col-md-6 align-self-center">
        <div class="row justify-content-start">
            <h2 class="col-12 h6"><?=$product["title"];?></h2>
            <p class="col-12"><?=$product["description"];?></p>
            <p class="col-12">Artikelnummer: <?=$product["ean"];?></p>
            <strong class="col-12"><?=$product["price"];?>€</strong>
            <?php if ($product["details"] != "") : ?>
                <h2 class="mt-3 col-12 h6">DETAILS</h2>
                <p class="col-12">
                <ul>
                    <?php
                    $details = explode(", ", $product["details"]);
                    foreach ($details AS $detail) {
                        echo "<li>".$detail."</li>";
                    }
                    ?>
                </ul>
                </p>
            <?php endif; ?>
            <p class="col-12">
            <?php
            $sql = 'SELECT * FROM ratings WHERE productid = ?';
            $prepared = $pdo->prepare($sql);
            $prepared->execute(array(
                $product["id"]
            ));
            $ratings = $prepared->fetchAll(PDO::FETCH_ASSOC);

            $ratingCounter = 0;
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

                $grayStars = 5 - $rating;

                for ($i = 0; $i < $grayStars; $i++) {
                    echo "<img src=\"images/star.png\" style=\"opacity:0.4;\" />";
                }

            } else {
                echo "Rating: product is not yet rated";
            }
            ?>
            </p>
        </div>
    </div>
    <div class="col-12 col-md-6 offset-md-6 align-self-end">
        <form method="post" action="index.php?action=add-to-bag&productid=<?=$product["id"];?>">
            <div class="input-group">
                <input class="form-control" type="number" name="amount" min="1" value="1" />
                <div class="input-group-append">
                    <input type="submit" class="btn btn-primary" value="add to cart" />
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-start">
        <div class="col-12 mt-5">
            <h4>Ratings</h4>
        </div>
        <div class="col-12 mb-5">
            <form action="./?page=addcomment&id=<?=$product["id"];?>" method="post">
                <div class="form-row justify-content-start">
                    <div class="col-6 form-group">
                        <label for="inputName">Title</label>
                        <input type="text" name ="name" class="form-control" id="inputName" placeholder="Title" required>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-6 form-group">
                        <label for="rating">Rating</label>
                        <select class="form-control" id="rating" name="rating" required>
                            <option>Please select</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-6 form-group">
                        <label for="inputComment">Comment</label>
                        <textarea name ="comment" class="form-control" id="inputComment" placeholder="Comment" required></textarea>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-6 form-group">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
        $sql = 'SELECT * FROM ratings WHERE productid = ?';
        $prepared = $pdo->prepare($sql);
        $prepared->execute(array(
            $product["id"]
        ));
        $ratings = $prepared->fetchAll(PDO::FETCH_ASSOC);

        foreach($ratings as $rating) {
            echo "<div class=\"col-12\">";
            echo "<h5>";
            echo $rating["name"];
            echo " ";
            for ($i = 0; $i < $rating["rating"]; $i++) {
                echo "<img src=\"images/star.png\" />";
            }
            $grayStars = 5 - $rating["rating"];

            for ($i = 0; $i < $grayStars; $i++) {
                echo "<img src=\"images/star.png\" style=\"opacity:0.4;\" />";
            }
            echo "</h4>";
            echo "<p>";
            echo $rating["comment"];
            echo "</p></div>";
        }
        ?>
    </div>
</div>