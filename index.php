<?php
    include("inc/uebergabe.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>my lovely home</title>
</head>
<body>
<?php
include "inc/header.php";
?>
<div class="container">
    <?php
        if (isset($_GET["category"])) {
        include("inc/category.php");
    } else if (isset($_GET["product"])) {
            include("inc/product.php");
    } else if(isset($_GET["page"])) {
        if ($_GET["page"] == "shoppingbag") {
            include("shoppingbag/shoppingbag.php");
        } else if ($_GET["page"] == "order") {
            include("ordersite/order.php");
        } else if ($_GET["page"] == "thankyouforyourorder") {
            include("ordersite/thankyou.php");
        } else if ($_GET["page"] == "imprint") {
            include("imprint/imprint.html");
        } else if ($_GET["page"] == "contact") {
            include("contact/contact.html");
        } else if ($_GET["page"] == "contactform") {
            include("contact/contactform.php");
        } else if ($_GET["page"] == "mailsent") {
            include("contact/mailsent.php");
        } else if ($_GET["page"] == "about-us") {
            include("aboutus/aboutus.html");
        } else if ($_GET["page"] == "faq") {
            include("faq/faq.html");
        } else if ($_GET["page"] == "search") {
            include("search/search.php");
        }

    } else {
        include("startseite/startseite.php");
    }
?>
</div>
<?php
include "inc/footer.php";
?>

</body>
</html>
