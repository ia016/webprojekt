<h2>Benutzer</h2>

<ul>
    <?php
    $sql = 'SELECT * FROM users ORDER BY id';
    $prepared = $pdo->prepare($sql);
    $prepared->execute();
    $users = $prepared->fetchAll(PDO::FETCH_ASSOC);

    foreach($users as $user) {
        echo "<ul>";
        echo $user["name"];
        echo " <a href=\"?manage=users&deleteuser=".$user["id"]."\">delete</a>";
        echo " <a href=\"?manage=edituser&user=".$user["id"]."\">edit</a>";
        echo "</ul>";
    }
    ?>
</ul>

<a href="?manage=adduser" class="btn btn-info" role="button">Benutzer hinzufügen</a>