<?php

$dbhost="localhost";
$dbuser= "ia016";
$dbpasswort="aShouj5To8";
$dbname="u-ia016";
$con= mysqli_connect("localhost","$dbuser","$dbpasswort","$dbname");

if (mysqli_connect_errno())
{
    echo "Keine Verbindung möglich" . mysqli_connect_error();
}
?>