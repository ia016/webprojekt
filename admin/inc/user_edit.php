<form action="?manage=users&edituser=<?=$selectedUser["id"];?>" method="post">
    <h4>Benutzer bearbeiten</h4>
    Benutzername:<br />
    <input type="text" name="name" value="<?=$selectedUser["name"];?>" /><br />
    Passwort:<br />
    <input type="password" name="password" /><br />
    <input type="submit" value="speichern" />
</form>