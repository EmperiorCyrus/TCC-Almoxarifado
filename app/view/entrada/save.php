<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Entrada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
        <div class="container">
            <h1>Entrada</h1>
            <form action="index.php?controller=lote&action=save" method="post">
        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Insira a quantidade do produto."required>
        </div>
        <div class="form-group">
            <label for="validade">Validade</label>
            <input type="text" class="form-control" id="validade" name="validade" placeholder="Insira a validade do produto.">
        </div>
        <div class="form-group">
            <label for="perecivel">Valor</label>
            <input type="valor" class="form-control" id="valor" name="valor" placeholder="Insira o valor do produto." required>
        </div>
        <button type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
        </form>
        </div>
        <script>
            
            function validateQuantidade() {
                var quantidade = document.getElementById("quantidade").value;

                if (quantidade === "") {
                    alert("A quantidade do produto deve ser informada.");
                    return false;
                }
                return true;
            }

            function validateValidade() {
                var validade = document.getElementById("validade").value;

                if (validade === "") {
                    alert("A validade do produto deve ser informada.");
                    return false;
                }
                return true;
            }
        
            function validateValor() {
                var valor = document.getElementById("valor").value;

                if (valor === "") {
                    alert("O valor do produto deve ser informado.");
                    return false;
                }

                return true;
            }
            // Valida os dados do formulário
            function validateForm() {
                return validateQuantidade() && validateValidade() && validateValor();
            }
        </script>
</body>
</html>