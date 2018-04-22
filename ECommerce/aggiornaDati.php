<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Conferma dettagli ordine</title>
        <link rel="stylesheet" type="text/css" href="stile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Kavoon' rel='stylesheet'>
    </head>
    <body>
        <a href="index.php"><h1 align='center' class="titolo">Prodotti per l'ufficio | Sito di E - Commerce</h1></a>
<?php

session_start();
$db = new PDO("sqlite:ecommerce.sqlite");
if (!$db) {
    die("Errore nell'apertura del database");
}
$username = $_SESSION["username"];
$indirizzo = $_POST["selectIndirizzo"]." ".$_POST["indirizzo"];
$nCivico = $_POST["nCivico"];
$metodoPagamento = $_POST["selectPagamento"];
$prezzoTot = $_SESSION["prezzoTot"];
$statement = $db->prepare("UPDATE DettagliUtente SET Indirizzo = '$indirizzo', nCivico = $nCivico, MetodoPagamento = '$metodoPagamento', Credito=Credito - $prezzoTot WHERE IDUtente='$username'")
        or die("Errore nella preparazione del database".$statement);
echo "Ordine effettuato. Sono stati addebidati €$prezzoTot dalla carta.";
?>
</body>
</html>

