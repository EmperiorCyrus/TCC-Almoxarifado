/**
 * Function responsável por manipular formulario.
 * Ele alterará a visibilidade dos formularios corespondente aos inputs radios.
 */
function option_register() {
    var form_produto = document.getElementById("form-produto");
    var form_fornecedor = document.getElementById("form-fornecedor");
    var form_local = document.getElementById("form-local");

    
    if (document.getElementById("produto").checked) {
        form_produto.style.display = "block";
        form_fornecedor.style.display = "none";
        form_local.style.display = "none";
        
    }
    if (document.getElementById("fornecedor").checked) {
        form_produto.style.display = "none";
        form_fornecedor.style.display = "block";
        form_local.style.display = "none";
        
    }
    if (document.getElementById("local").checked) {
        form_produto.style.display = "none";
        form_fornecedor.style.display = "none";
        form_local.style.display = "block";
        
    }
}