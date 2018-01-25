<form action="?manage=products&editproduct=<?=$selectedProduct["id"];?>" method="post" enctype="multipart/form-data">
	<h4>Produkt hinzufügen</h4>
	<div class="form-row">
		<div class="form-group col-6">
			<label for="name">Produktname</label>
			<input type="text" name="name" class="form-control" id="name"
				   placeholder="Produktname" value="<?=$selectedProduct["name"];?>">
		</div>
		<div class="form-group col-6">
			<label for="title">Titel</label>
			<input type="text" name="title" class="form-control" id="title"
				   placeholder="Titel" value="<?=$selectedProduct["title"];?>">
		</div>
		<div class="form-group col-6">
			<label for="description">Beschreibung</label>
			<textarea class="form-control" name="description" id="description" rows="3" placeholder="Beschreibung"><?= $selectedProduct["description"]; ?></textarea>
		</div>
		<div class="form-group col-6">
			<label for="details">Details (mit Komma getrennt eingeben)</label>
			<textarea class="form-control" name="details" id="details" rows="3" placeholder="Details"><?= $selectedProduct["details"];?></textarea>
		</div>
		<div class="form-group col-4">
			<label for="category">Kategorie</label>
			<select id="category" name="category" class="form-control">
                <?php
                foreach($allCategories as $category) {
                    if ($selectedProduct["categoryid"] == $category["id"]) {
                        echo "<option selected=\"selected\" value=\"" . $category["id"] . "\">" . $category["name"] . "</option>";
                    } else {
                        echo "<option value=\"" . $category["id"] . "\">" . $category["name"] . "</option>";
                    }
                }
                ?>
			</select>
		</div>
		<div class="form-group col-4">
			<label for="price">Preis</label>
			<input type="text" name ="price" class="form-control" id="price"
				   placeholder="Preis" value="<?= $selectedProduct["price"]; ?>">
		</div>
		<div class="form-group col-4">
			<label for="ean">EAN-Code</label>
			<input type="text" name ="ean" class="form-control" id="ean"
				   placeholder="EAN-Code" value="<?= $selectedProduct["ean"]; ?>">
		</div>
		<div class="form-group col-6">
			<label for="foto">Foto</label>
			<input type="file" name ="foto" class="form-control" id="foto" placeholder="Foto">
			<img width="300" src="./../images/products/<?=$selectedProduct["image"];?>" />
		</div>
		<div class="w-100"></div>
		<div class="col-6">
			<button class="btn btn-primary" type="submit">Speichern</button>
		</div>
	</div>
</form>