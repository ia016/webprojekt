<h4>Kategorie bearbeiten</h4>
<form action="?manage=categories&editcategory=<?=$selectedCategory["id"];?>" method="post">
	<label class="form-control-label text-muted" for="category">Kategorie:</label>
	<div class="form-row">
		<input type="text" id="category" name="name" value="<?=$selectedCategory["name"];?>" />
		<input class="btn btn-primary" type="submit" value="speichern" />
	</div>
</form>