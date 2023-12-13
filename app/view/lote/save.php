<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Lote</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
        <div class="container">
            <h1>Cadastro de Lote</h1>
            <form action="index.php?controller=lote&action=save" method="post">
        <div class="form-group">
            <label for="data_cadastro">Data de Cadastro</label>
            <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" required>
        </div>
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="CÓDIGO">
        </div>
        <div class="form-group">
            <label for="id_nota">Id Nota</label>
            <input type="text" class="form-control" id="id_nota" name="id_nota" placeholder="ID DA NOTA" required>
        </div>
        <button type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
        </form>
        </div>
        <script>
            // Valida o nome da nota fiscal
            function validateData() {
                var data_cadastro = document.getElementById("data_cadastro").value;

                if (data_cadastro === "") {
                    alert("A data do lote deve ser preenchida.");
                    return false;
                }

                return true;
            }

            // Valida o caminho do arquivo
            function validateIdnota() {
                var id_nota = document.getElementById("id_nota").value;

                if (id_nota === "") {
                    alert("O Id da nota deve ser informado");
                    return false;
                }
                return true;
            }
            // Valida os dados do formulário
            function validateForm() {
                return validateData() && validateIdnota();
            }
        </script>
</body>
</html>