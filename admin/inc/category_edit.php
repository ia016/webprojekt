<form action="?manage=categories&editcategory=<?=$selectedCategory["id"];?>" method="post">
    <h4>Kategorie bearbeiten</h4>
    <input type="text" name="name" value="<?=$selectedCategory["name"];?>" /><input type="submit" value="speichern" />
</form>