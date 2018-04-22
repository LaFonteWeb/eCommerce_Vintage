<?php
session_start();
$_SESSION["login"] = false;
$_SESSION["messaggio"] = "Logout avvenuto con successo";
header("location: index.php");
?>

