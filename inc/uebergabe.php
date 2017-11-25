<?php


try {
    $pdo = new PDO('mysql:dbhost=localhost; dbname=u-ia016', 'ia016', 'aShouj5To8');
}

catch (PDOException $p) {
    echo ("Fehler beim Aufbau der Datenverbindung.");
    print_r($p);
    die();
}
?>