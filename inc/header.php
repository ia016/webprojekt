<div id="header">

    <h1 class="mylovelyhome"><a href="index.php">my lovely home</a></h1>
    <hr/>

    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                data-target="#navbar" aria-controls="navbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="mx-auto navbar-nav mr-auto">
                <?php
                    $sql = 'SELECT * FROM categories ORDER BY id';
                    $prepared = $pdo->prepare($sql);
                    $prepared->execute();
                    $categories = $prepared->fetchAll(PDO::FETCH_ASSOC); //sql vorbereiten und ausführen - fetch all holt alles in assoziat. Array


                    foreach($categories as $category) {
                        if (isset($_GET["category"]) && $_GET["category"] == $category["id"]) {
                            echo "<li class='nav-item active'><a class='nav-link' href=\"index.php?category=".$category["id"]."\">".$category["name"]."</a></li>\n";
                        } else {
                            echo "<li class='nav-item'><a class='nav-link' href=\"index.php?category=".$category["id"]."\">".$category["name"]."</a></li>\n";
                        }
                    }
                ?>
                <li class='nav-item'>
                    <a class='nav-link' href="index.php?page=shoppingbag">
                        <img src="images/shopping-bag.png" width="25" height="25" alt="Shopping bag">
                    </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href="index.php?page=search">
                        <img src="images/search.png" width="25" height="25" alt="Search">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <hr/>
</div>