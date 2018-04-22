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
        <?php
        session_start();
        $db = new PDO("sqlite:ecommerce.sqlite");
        if (!$db) {
            die("Errore nell'apertura del database");
        }
        $username = $_SESSION["username"];
        $statement = $db->prepare("SELECT * FROM DettagliUtente WHERE IDUtente='$username'") or die("Errore nella preparazione del database");
        $statement->execute() or die("Impossibile aggiornare i dati");
        $row = $statement->fetch();
        $_SESSION["indirizzo"] = $row["Indirizzo"];
        $_SESSION["nCivico"] = $row["nCivico"];
        ?>
        <a href="index.php"><h1 align='center' class="titolo">Prodotti per l'ufficio | Sito di E - Commerce</h1></a>
        <a href="carrello.php" id="indietroCarrello" style="margin-left: 0px;">🢢Torna indietro</a><br><br>
        <form action="aggiornaDati.php" method="post">
            <select id='selectIndirizzo' name="selectIndirizzo" required=""><option value='' selected disabled="disabled">Piazza, via o viale</option>
                <option value='Piazza'>Piazza</option><option value='Via'>Via</option><option value='Viale'>Viale</option></select>
            <?php
            $indirizzo = $_SESSION["indirizzo"];
            echo "<input type='text' id='indirizzo' name='indirizzo' placeholder='Indirizzo: ' style='display: inline;' required value='$indirizzo'>";
            ?>
            <?php
            $nCivico = $_SESSION["nCivico"];
            echo "<input type='number' id='nCivico' name='nCivico' placeholder='N° civico: ' min='0' max='200' style='display: inline;' required value='$nCivico'><br>";
            ?>
            <select id="selectPagamento" name="selectPagamento" required=""><option value="" selected disabled="disabled">Metodo di pagamento</option>
                <option value='Buono regalo'>Buono regalo</option><option value='Carta di credito'>Carta di credito</option><option value='Pagamento alla consegna'>Pagamento alla consegna</option></select>
            <button type="submit" class="button" id="conferma">Conferma <i class="fa fa-check"></i></button>
                <?php
                $prezzo = 0;
                $prodotti = array();
                $numProdotti = $_SESSION["nProdotti"];
                for ($i = 0; $i < $numProdotti; $i++) {
                    if (isset($_POST["$i"])) {
                        $prezzo += $_POST["$i"];
                    }
                }
                $_SESSION["prezzoTot"] = $prezzo;
                ?>
        </form>
    </body>
</html>

