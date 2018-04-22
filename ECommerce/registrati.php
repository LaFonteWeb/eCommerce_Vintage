<link rel="stylesheet" type="text/css" href="stile.css" >
<link href='https://fonts.googleapis.com/css?family=Kavoon' rel='stylesheet'>
<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] == false) {
    $db = new PDO("sqlite:ecommerce.sqlite");
    if (!$db) {
        die("Errore nell'apertura del database");
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    if($password == $password2){
    $statement = $db->prepare("INSERT INTO Utenti(nome, password) VALUES ('$username', '$password')") or die("Errore nella preparazione del database");
    $statement->execute() or die("<div id='messaggio' style='margin-left:5px;'>Le password non corrispondono.</div>");
    //$row = $statement->fetch();
    $indirizzo =  $_POST["selectIndirizzo"]." ".$_POST["indirizzo"];
    $nCivico = $_POST["nCivico"];
    $metodoPagamento = $_POST["selectPagamento"];
    $credito = random_int(0, 1500);
    $statement = null;
    $statement = $db->prepare("INSERT INTO DettagliUtente VALUES('$username', '$indirizzo', $nCivico, '$metodoPagamento', $credito)");
    $statement->execute();
    $_SESSION["messaggio"] = "Registrazione avvenuta con successo. E' possibile effettuare il login.";
    $db = null;
    }else{
        $_SESSION["messaggio"] = "Le password inserite non corrispondono. Riprovare.";
    }
    header("location: index.php");
}
?>

