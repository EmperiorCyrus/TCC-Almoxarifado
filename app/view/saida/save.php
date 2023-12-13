<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Saida</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
        <div class="container">
            <h1>Saida</h1>
            <form action="index.php?controller=lote&action=save" method="post">
        <div class="form-group">
            <label for="data_cadastro">Data Cadastro</label>
            <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" placeholder="Insira a data da saida."required>
        </div>
        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Insira a quantidade da saida.">
        </div>
        <button type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
        </form>
        </div>
        <script>
            
            function validateData() {
                var data_cadastro = document.getElementById("data_cadastro").value;

                if (data_cadastro === "") {
                    alert("A data da saida deve ser informada");
                    return false;
                }
                return true;
            }

            function validateQuantidade() {
                var quantidade = document.getElementById("quantidade").value;

                if (quantidade === "") {
                    alert("A quantidade da saida deve ser informada.");
                    return false;
                }
                return true;
            }
            // Valida os dados do formulário
            function validateForm() {
                return validateData() && validateQuantidade();
            }
        </script>
</body>
</html>