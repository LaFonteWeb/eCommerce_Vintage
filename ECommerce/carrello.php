<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Carrello</title>
        <link rel="stylesheet" type="text/css" href="stile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Kavoon' rel='stylesheet'>
        <script type="text/javascript" src="/JavaScripts/aggiornaPrezzo.js"></script>
    </head>
    <body>
        <a href="index.php"><h1 align='center' class="titolo">Prodotti per l'ufficio | Sito di E - Commerce</h1></a>
        <a href="index.php" id="indietroCarrello">🢢Torna indietro</a>

        <form action="acquisto.php" method="post">
            <button  id="proseguiAcquisto" class="button" type="submit">Prosegui con l'acquisto <i class="fa fa-money"></i></button>
            <table>
                <?php

                function aggiungiDropDown($quantita, $prezzo, $IDProdotto) {
                    if ($quantita >= 1) {
                        $n = 1;
                        echo "<td>Quantità : <select id='$IDProdotto' onchange='aggiornaPrezzo($prezzo, $IDProdotto)'>";
                        while ($quantita >= 1) {
                            $quantita--;
                            echo "<option  value='$n'>$n</option>";
                            $n++;
                        }
                        echo "</select></td>";
                    }
                }

                session_start();
                if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
                    $username = $_SESSION["username"];
                    $db = new PDO("sqlite:ecommerce.sqlite");
                    if (!$db) {
                        die("Errore nell'apertura del database");
                    }
                    $statement = $db->prepare("SELECT * FROM Prodotti INNER JOIN Carrello ON Carrello.IDProdotto = Prodotti.ID WHERE Carrello.IDUtente = '$username'")
                            or die("Errore nella preparazione del database");
                    $statement->execute() or die("Errore nell'accesso al database");
                    while ($row = $statement->fetch()) {
                        $_SESSION["codice"] = $row["ID"];
                        $_SESSION["paginaCarrello"] = true;
                        echo "<tr><td><a href='prodotto.php?codice=", $row["ID"], "'><div>", $row["nome"], "</div></a></td>";
                        echo "<td><a href='prodotto.php?codice=", $row["ID"], "'><img width='150' height='110' src='/Immagini/", $row["ID"], ".png'></a></td>";
                        aggiungiDropDown(intval($row["quantita"]), intval($row["prezzo"]), intval($row["ID"]));
                        $id = $row["ID"];
                        echo "<td>Prezzo: €<span id='prezzo$id'>", $row["prezzo"], "</span></td>";
                        echo "<td><a href='rimuoviDaCarrello.php?codice=$id'><img width='150' height='110' src='/Immagini/rimuoviDaCarrello.png'></a></td>";
                        echo "<td style='display:none;'><input type='hidden' id='codProdotto$id' name='$id' value='", $row["prezzo"], "'></td></tr>";
                    }
                }
                ?>
            </table>
        </form>
    </body>
</html>