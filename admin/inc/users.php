<?php
	$sql = 'SELECT * FROM users ORDER BY id';
	$prepared = $pdo->prepare($sql);
	$prepared->execute();
	$users = $prepared->fetchAll(PDO::FETCH_ASSOC);

	echo "<div class=\"table-responsive\">";
	echo "<table class=\"table table-striped\">";
	echo "<tr><th colspan=\"2\">Benutzer</th></tr>";

	foreach($users as $user) {
		echo "<tr><td>".$user["name"]."</td>";
		echo "<td align=right><div class=\"btn-group\" role=\"group\">";
		echo "<a class=\"btn btn-sm btn-danger\" href=\"?manage=users&deleteuser=".$user["id"]."\">delete</a>";
		echo "<a class=\"btn btn-sm btn-warning\" href=\"?manage=edituser&user=".$user["id"]."\">edit</a>";
		echo "</div></td></tr>";
	}

	echo "</table></div>";
?>

<a href="?manage=adduser" class="btn btn-info" role="button">Benutzer hinzufügen</a>