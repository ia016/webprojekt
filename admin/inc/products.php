<?php
                $sql = 'SELECT * FROM products ORDER BY id';
                $prepared = $pdo->prepare($sql);
                $prepared->execute();
                $products = $prepared->fetchAll(PDO::FETCH_ASSOC);

                echo "<div class=\"table-responsive\">";
                echo "<table class=\"table table-striped\">";
                echo "<tr><th colspan=\"2\">Produkte</th></tr>";

                foreach($products as $product) {
                    echo "<tr><td>".$product["name"]."</td>";
                    echo "<td align=right><div class=\"btn-group\" role=\"group\">";
                    echo "<a class=\"btn btn-sm btn-danger\" href=\"?manage=products&deleteproduct=".$product["id"]."\">delete</a> ";
                    echo "<a class=\"btn btn-sm btn-warning\" href=\"?manage=editproduct&product=".$product["id"]."\">edit</a> ";
                    echo "<a class=\"btn btn-sm btn-info\" target=\"blank\" href=\"./../?product=".$product["id"]."\">im Shop anzeigen</a>";
                    echo "</div></td></tr>";
                }

                echo "</table></div>"
                ?>

<a href="?manage=addproduct" class="btn btn-info" role="button">Produkt hinzufügen</a>
