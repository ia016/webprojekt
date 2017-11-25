<h1 class="mylovelyhome"><a href="index.php">my lovely home</a></h1>
<hr/>

<ul class="mainnavigation">
    <?php
        $sql = 'SELECT * FROM categories ORDER BY id';
        $prepared = $pdo->prepare($sql);
        $prepared->execute();
        $categories = $prepared->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array

        foreach($categories as $category) {
            echo "<li><a href=\"index.php?category=".$category["id"]."\">".$category["name"]."</a></li>";
        }
    ?>
    <li><a href="index.php?page=account&action=anzeigen"><img src="images/shopping-bag.png" width="25" height="25" alt="Shopping bag"></a></li>
</ul>
<hr/>