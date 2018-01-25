<form action="?manage=users&adduser=1" method="post">
	<h4>Benutzer hinzufügen</h4>
	<div class="form-row">
		<div class="form-group col-6">
			<label for="inputUser">Benutzername</label>
			<input type="email" name ="name" class="form-control" id="inputUser" placeholder="Benutzername">
		</div>
		<div class="w-100"></div>
		<div class="form-group col-6">
			<label for="inputPassword">Passwort</label>
			<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Passwort">
		</div>
		<div class="w-100"></div>
		<div class="col-6">
			<button class="btn btn-primary" type="submit">Speichern</button>
		</div>
	</div>
</form>