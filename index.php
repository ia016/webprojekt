<?php
    include("inc/uebergabe.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <link href="style/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


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
    } else {
        include("inc/productdetail.php");
    }
?>
</div>
<?php
include "inc/footer.php";
?>

</body>
</html>
