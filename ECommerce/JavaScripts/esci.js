window.onload = function () {
    var btnEsci = document.getElementById("btnEsci");
    btnEsci.addEventListener("click", function(){
        var btnAccedi = document.getElementById("btnAccedi");
        btnAccedi.setAttribute("style", "display:block;");
        var btnRegistrati = document.getElementById("btnRegistrati");
        btnAccedi.setAttribute("style", "display:block;");
        alert("dsf");
        btnEsci.setAttribute("style", "display:none;");
    });
   
};


