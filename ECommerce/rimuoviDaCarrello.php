<?php
session_start();
        if ($_SESSION["login"] == true) {
            //$codice = $_SESSION["codice"];
            $codice = $_GET["codice"];
            $username = $_SESSION["username"];
            $db = new PDO("sqlite:ecommerce.sqlite");
            if (!$db) {
                die("Errore nell'apertura del database");
            }
            $statement = $db->prepare("DELETE FROM Carrello WHERE IDProdotto = '$codice' AND IDUtente='$username'")
                    or die("Errore nella preparazione del database");
            $statement->execute() or die("Errore nell'accesso al database");
            $db = null;
            header("location: carrello.php");
        }
?>