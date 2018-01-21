<?php
    $sql = 'SELECT * FROM products, productdetails WHERE products.id = ? AND productdetails.productid = products.id';
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
            <strong class="col-12"><?=$product["price"];?>€</strong>
            <h2 class="mt-3 col-12 h6">DETAILS</h2>
            <p class="col-12"><?=$product["detail"];?>€</p>
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
</div>