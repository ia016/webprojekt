<form action="?manage=products&addproduct=1" method="post" enctype="multipart/form-data">
	<h4>Produkt hinzufügen</h4>
	<div class="form-row">
		<div class="form-group col-6">
			<label for="name">Produktname</label>
			<input type="text" name="name" class="form-control" id="name" placeholder="Produktname">
		</div>
		<div class="form-group col-6">
			<label for="title">Titel</label>
			<input type="text" name="title" class="form-control" id="title" placeholder="Titel">
		</div>
		<div class="form-group col-6">
			<label for="description">Beschreibung</label>
			<textarea class="form-control" name="description" id="description" rows="3" placeholder="Beschreibung"></textarea>
		</div>
		<div class="form-group col-6">
			<label for="details">Details (mit Komma getrennt eingeben)</label>
			<textarea class="form-control" name="details" id="details" rows="3" placeholder="Details"></textarea>
		</div>
		<div class="form-group col-4">
			<label for="category">Kategorie</label>
			<select id="category" name="category" class="form-control">
                <?php
                foreach($allCategories as $category) {
                    echo "<option value=\"".$category["id"]."\">".$category["name"]."</option>";
                }
                ?>
			</select>
		</div>
		<div class="form-group col-4">
			<label for="price">Preis</label>
			<input type="text" name ="price" class="form-control" id="price" placeholder="Preis">
		</div>
		<div class="form-group col-4">
			<label for="title">EAN-Code</label>
			<input type="text" name ="ean" class="form-control" id="ean" placeholder="EAN-Code">
		</div>
		<div class="form-group col-6">
			<label for="foto">Foto</label>
			<input type="file" onchange="readURL(this);" name="foto" accept="image/*" class="form-control" id="foto" placeholder="Foto">
			<img id="upload" width="300" />
		</div>
		<div class="w-100"></div>
		<div class="col-6">
			<button class="btn btn-primary" type="submit">Speichern</button>
		</div>
	</div>
</form>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#upload').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>