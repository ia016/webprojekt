<h1>Order Overview</h1>

<form action="?page=order" method="post" role="form">

<div class="row justify-content-start">

    <div class="col-12 col-md-8">
        <div class="card col-12">
            <div class="card-body row justify-content-between">
                <h4 class="card-title">Coupon Code</h4>
                <a data-toggle="collapse" href="#collapseCoupon" aria-expanded="false" aria-controls="collapseCoupon">
                    <i class="fa fa-angle-down fa-3x"></i>
                </a>
            </div>
            <div class="collapse col-auto" id="collapseCoupon">
                <div class="form-group">
                    <label class="form-control-label text-muted" for="field_coupon_code">Enter Code:</label>
                    <input name="coupon_code" type="text" class="form-control" id="field_coupon_code">
                </div>
            </div>
        </div>

        <div class="card col-12 mt-3">
            <div class="card-body row justify-content-between">
                <h4 class="card-title col-12">Personal Information</h4>
                <ul class="nav nav-tabs col-12" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="distribution-address-tab" data-toggle="tab" href="#distributionAddress" role="tab"
                           aria-controls="distribution-address" aria-selected="true">Distribution Address</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="bill-address-tab" data-toggle="tab" href="#billAddress" role="tab"
                           aria-controls="bill-address" aria-selected="false">Bill Address</a>
                    </li>
                </ul>
                <div class="tab-content col-12" id="personalInformationContent">

                    <div class="tab-pane fade show active" id="distributionAddress" role="tabpanel" aria-labelledby="distribution-address-tab">
                            <div class="form-group mt-3 col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Name and first name:</label>
                                <input type="text" class="form-control" name="dist_name" id="dist_name" required>
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Street and Housenumber:</label>
                                <input type="text" class="form-control" name="dist_address" id="dist_address" required>
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">City:</label>
                                <input type="text" class="form-control" name="dist_city" id="dist_city" required>
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Postcode:</label>
                                <input type="number" class="form-control" name="dist_postcode" id="dist_postcode" required>
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Country:</label>
                                <input type="text" class="form-control" name="dist_country" id="dist_country" required>
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Email Address:</label>
                                <input type="text" class="form-control" id="field_coupon_code" name="dist_email", id="dist_email" required>
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Mobile number:</label>
                                <input type="number" class="form-control" name="dist_mobil" id="dist_mobil" required>
                            </div>
                    </div>

                    <div class="tab-pane fade" id="billAddress" role="tabpanel" aria-labelledby="bill-address-tab">
                            <div class="form-group mt-3 col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Name and first name:</label>
                                <input type="text" class="form-control" name="bill_name" id="bill_name">
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Street and Housenumber:</label>
                                <input type="text" class="form-control" name="bill_address" id="bill_address">
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">City:</label>
                                <input type="text" class="form-control" name="bill_city" id="bill_city">
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Postcode:</label>
                                <input type="number" class="form-control" name="bill_postcode" id="bill_postcode">
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Country:</label>
                                <input type="text" class="form-control" name="bill_country" id="bill_country">
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Email Address:</label>
                                <input type="text" class="form-control" name="bill_email" id="bill_email">
                            </div>
                            <div class="form-group col-12">
                                <label class="form-control-label text-muted" for="field_coupon_code">Mobile number:</label>
                                <input type="number" class="form-control" name="bill_mobil" id="bill_mobil">
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-12 mt-3">
            <div class="card-body row justify-content-between">
                <h4 class="card-title">Distribution Options</h4>

                <hr>

                <div class="col-12">
                    <div class="mt-3 row justify-content-around">
                        <div class="col-9 order-2 col-sm-3 order-sm-1">
                            <p class="h6">KOSTENLOS</p>
                        </div>
                        <div class="col-12 order-1 col-sm-8 order-sm-2">
                            <div class="font-weight-bold">Standard Delivery</div>
                            <div class="mt-0 mt-sm-3 mb-3 mb-sm-0 text-muted">Delivery in 3-4 workdays</div>
                        </div>
                        <div class="my-auto col-3 order-3 col-sm-1 order-sm-3">
                            <input type="radio" name="distributionType">
                        </div>
                    </div>

                    <hr>

                    <div class="mt-5 row justify-content-around">
                        <div class="col-9 order-2 col-sm-3 oder-sm-1">
                            <p class="h6">5,00 €</p>
                        </div>
                        <div class="col-12 order-1 col-sm-8 order-sm-2">
                            <div class="font-weight-bold">Express</div>
                            <div class="mt-0 mt-sm-3 mb-3 mb-sm-0 text-muted">Delivery in 2 workdays</div>
                        </div>
                        <div class="my-auto col-3 order-3 col-sm-1 order-sm-3">
                            <input type="radio" name="distributionType">
                        </div>
                        <hr>
                    </div>

                    <hr>

                    <div class="mt-5 row justify-content-around">
                        <div class="col-9 order-2 col-sm-3 oder-sm-1">
                            <p class="h6">10,00 €</p>
                        </div>
                        <div class="col-12 order-1 col-sm-8 order-sm-2">
                            <div class="font-weight-bold">Delivery tomorrow</div>
                        </div>
                        <div class="my-auto col-3 order-3 col-sm-1 order-sm-3">
                            <input type="radio" name="distributionType">
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-12 mt-3">
            <div class="card-body row justify-content-between">
                <h4 class="card-title">Payment Options</h4>
                <div class="col-12">
                    <div class="mt-3 row justify-content-around">
                        <div class="col-11">
                            <div class="font-weight-bold">Bill</div>
                            <div class="mt-3 text-muted">TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST</div>
                        </div>
                        <div class="my-auto col-1">
                            <input type="radio" name="billType">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-none d-md-block col-4" style="padding-left: 0">
        <div class="card col-12" style="position: sticky; position: -webkit-sticky; top: 0;">
            <div class="card-body row justify-content-between">
                <h1>Shopping bag</h1>
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
                    ?>
                        <div>
                            <h3><?=$product["amount"];?>x <?=$product["name"];?></h3>
                            <p><?=money_format('%.2n', $product["total"]);?>€</p>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="col-auto">
    <button type="submit" name="submitButton" class="btn btn-primary">Submit</button>
</div>


</form>
