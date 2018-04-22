function aggiornaPrezzo(prezzo, IDProdotto) {
    var select = document.getElementById(IDProdotto);
    var quantita = select.options[select.selectedIndex].value;
    document.getElementById("prezzo"+IDProdotto).innerHTML = quantita * prezzo;
    document.getElementById("codProdotto"+IDProdotto).value = quantita * prezzo;
}

