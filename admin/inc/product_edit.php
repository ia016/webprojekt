
                <h3>Produkt bearbeiten</h3>
                <form action="?manage=products&editproduct=<?=$selectedProduct["id"];?>" method="post" enctype="multipart/form-data">
                    Produktname:<br />
                    <input type="text" name="name" value="<?=$selectedProduct["name"];?>" /><br />
                    Titel:<br />
                    <input type="text" name="title" value="<?=$selectedProduct["title"];?>"/><br />
                    Beschreibung:<br />
                    <textarea name="description"><?= $selectedProduct["name"]; ?></textarea><br />
                    Kategorie:<br />
                    <select name="category">
                        <?php
                        foreach($allCategories as $category) {
                            if ($selectedProduct["categoryid"] == $category["id"]) {
                               echo "<option selected=\"selected\" value=\"" . $category["id"] . "\">" . $category["name"] . "</option>";
                            } else {
                                echo "<option value=\"" . $category["id"] . "\">" . $category["name"] . "</option>";
                            }
                        }
                        ?>
                    </select><br />
                    Details (mit Komma getrennt eingeben):<br />
                    <textarea name="details"><?=$selectedProduct["details"];?></textarea><br />
                    Preis:<br />
                    <input type="text" name="price" value="<?= $selectedProduct["price"]; ?>" /><br />
                    Foto:<br />
                    <img width="200" src="./../images/products/<?=$selectedProduct["image"];?>" /><br />
                    <input type="file" name="foto" value="<?= $selectedProduct["image"]; ?>" /><br />
                    EAN-Code<br />
                    <input type="text" name="ean" value="<?= $selectedProduct["ean"]; ?>"  /><br />
                    <input type="submit" value="speichern" />
                </form>