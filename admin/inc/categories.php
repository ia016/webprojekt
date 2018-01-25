<?php
    $sql = 'SELECT * FROM categories ORDER BY id';
    $prepared = $pdo->prepare($sql);
    $prepared->execute();
    $categories = $prepared->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class=\"table-responsive\">";
    echo "<table class=\"table table-striped\">";
    echo "<tr><th colspan=\"2\">Kategorien</th></tr>";

    foreach($categories as $category) {
        echo "<tr><td>".$category["name"]."</td>";
        echo "<td align=right><div class=\"btn-group\" role=\"group\">";
        echo "<a class=\"btn btn-sm btn-danger\" href=\"?manage=categories&deletecategory=".$category["id"]."\">delete</a>";
        echo "<a class=\"btn btn-sm btn-warning\" href=\"?manage=editcategory&editcategory=".$category["id"]."\">edit</a>";
        echo "</div></td></tr>";
    }

    echo "</table></div>";
?>

<a href="?manage=addcategory" class="btn btn-info" role="button">Kategorie hinzufügen</a>
