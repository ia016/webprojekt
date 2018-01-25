<h3>Produkt hinzufügen</h3>
                <form action="?manage=products&addproduct=1" method="post" enctype="multipart/form-data">
                    Produktname:<br />
                    <input type="text" name="name" /><br />
                    Titel:<br />
                    <input type="text" name="title" /><br />
                    Beschreibung:<br />
                    <textarea name="description"></textarea><br />
                    Kategorie:<br />
                    <select name="category">
                        <?php
                            foreach($allCategories as $category) {
                                echo "<option value=\"".$category["id"]."\">".$category["name"]."</option>";
                            }
                        ?>
                    </select><br />
                    Details (mit Komma getrennt eingeben):<br />
                    <textarea name="details"></textarea><br />
                    Preis:<br />
                    <input type="text" name="price" /><br />
                    Foto:<br />
                    <input type="file" name="foto" /><br />
                    EAN-Code<br />
                    <input type="text" name="ean" /><br />
                    <input type="submit" value="speichern" />
                </form>