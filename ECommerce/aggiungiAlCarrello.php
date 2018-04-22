<?php

session_start();
if ($_SESSION["login"] == true) {
    if ($_SESSION["aggiuntoCarrello"] == false) {
        $_SESSION["aggiuntoCarrello"] = true;
        $db = new PDO("sqlite:ecommerce.sqlite");
        if (!$db) {
            die("Errore nell'apertura del database");
        }
        $codice = $_GET["codice"];
        $_SESSION["codice"] = $codice;
        $username = $_SESSION["username"];
        $statement = $db->prepare("SELECT * FROM Carrello");
        $statement->execute();
        $presente = false;
        while ($row = $statement->fetch()) {
            if ($codice == $row["IDProdotto"] && $_SESSION["username"] == $row["IDUtente"]) {
                $presente = true;
            }
        }
        if ($presente == false) {
            echo "INSERT INTO Carrello VALUES('",$_SESSION["username"],"', $codice)";
            $statement = $db->prepare("INSERT INTO Carrello('IDUtente', IDProdotto) VALUES('$username', $codice)");
            $statement->execute() or die("Errore nell'accesso al database");
            $db = null;
            $_SESSION["erroreCarrello"] = "";
        } else {
            $_SESSION["erroreCarrello"] = "Articolo già presente nel carrello";
        }
        
    }
} else {
    $_SESSION["messaggio"] = "Effettuare il login per aggiungere un prodotto al carrello";
    header("location: index.php");
}
$codice = $_SESSION["codice"];
header("location: prodotto.php?codice=$codice");
?>
