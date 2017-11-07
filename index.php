
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <meta charset="UTF-8">
    <title>my lovely home</title>
</head>
<body>
<div class="container">
<h1 class="mylovelyhome">my lovely home</h1>
<hr/>

<ul class="mainnavigation">
    <li><a href="index.php?page=account&action=logout">HOME DECOR</a></li>
    <li><a href="index.php?page=account&action=ansehen">HOME TEXTILES</a></li>
    <li><a href="index.php?page=account&action=aendern">PAPER GOODS</a></li>
    <li><a href="index.php?page=account&action=anzeigen"><img src="images/shopping-bag.png" width="25" height="25" alt="Shopping bag"></a></li>
    </li>
</ul>
<hr/>

<?php
include "startseite/startseite.php";
?>


<footer>
    <hr/>
    <ul class="mainnavigation">
        <li><a href="index.php?page=account&action=imprint">IMPRINT</a></li>
        <li><a href="index.php?page=account&action=contact">CONTACT</a></li>
        <li><a href="index.php?page=account&action=aboutus">ABOUT US</a></li>
        <li><a href="index.php?page=account&action=faq">FAQ</a></li>
        </li>
    </ul>
    <hr/>

    <img class="footer" src="../images/instagram.png" width="25" height="25" alt="instagram">
    <img class="footer" src="../images/facebook-letter-logo.png" width="25" height="25" alt="facebook">
</footer>

</div>
</body>
</html>