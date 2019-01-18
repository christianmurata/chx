"use strict";

(function(){
    // carrega um select box com as categorias
    carregaCategorias();
})();

function carregaCategorias(){
    postRequest("/request", "data=categoria", function (data) {
        const categorias = JSON.parse(data);
        const select = document.getElementById("categoria");

        for(let i = 0; i < categorias.length; i++){
            let option = document.createElement("option");

            option.text  = categorias[i].titulo;
            option.value = categorias[i].id 

            select.add(option);
        }

    });
}