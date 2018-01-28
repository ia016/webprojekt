<div id="slider_home" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="d-block img-fluid img-100" src="images/slider1" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid img-100" src="images/slider2" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid img-100" src="images/slider3" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#slider_home" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider_home" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="mt-5 text-center Oberueberschirft">NEW ARRIVALS</div>
<div class="row justify-content-center">
    <?php
    $sql = 'SELECT id, name, price, image FROM products ORDER BY id DESC LIMIT 4';
    $prepared = $pdo->prepare($sql);
    $prepared->execute();
    $products = $prepared->fetchAll(PDO::FETCH_ASSOC);

    foreach($products as $product) {
        echo "<div class='new-release mt-4 col-12 col-sm-6 col-lg-3'>";
        echo "<a href='index.php?product=".$product["id"]."'>";
        echo "<div class='card img-container'>";
        echO "<div class='overlay'><div>Show</div></div>";
        echo "<img class='card-img-top' width='100%' src='images/products/".$product["image"]."'>";
        echo "<div class='card-body'><h5>".$product["name"]."</h5>";
        echo "<p class='text-muted'>".money_format('%.2n', $product["price"])."€"."</p>";
        echo "</div></div></a></div>";
    }
    ?>
</div>