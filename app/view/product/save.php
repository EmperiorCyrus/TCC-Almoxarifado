<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
        <div class="container">
            <h1>Cadastro de Produto</h1>
            <form action="index.php?controller=lote&action=save" method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome do produto"required>
        </div>
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" placeholder="Insira a marca do produto ">
        </div>
        <div class="form-group">
            <label for="perecivel">Perecivel</label>
            <input type="text" class="form-control" id="perecivel" name="perecivel" placeholder="Informe se o produto é perecivel" required>
        </div>
        <div class="form-group">
            <label for="descartavel">Descartavel</label>
            <input type="text" class="form-control" id="descartavel" name="descartavel" placeholder="Informe se o produto é descartavel" required>
        </div>
        <button type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
        </form>
        </div>
        <script>
            // Valida o nome da nota fiscal
            function validateNome() {
                var nome = document.getElementById("nome").value;

                if (nome === "") {
                    alert("O nome do produto deve ser informado.");
                    return false;
                }

                return true;
            }

            // Valida o caminho do arquivo
            function validateMarca() {
                var marca = document.getElementById("marca").value;

                if (marca === "") {
                    alert("A Marca do produto deve ser informada.");
                    return false;
                }
                return true;
            }
            function validatePerecivel() {
                var perecivel = document.getElementById("perecivel").value;

                if (perecivel === "") {
                    alert("Deve ser informado se o produto é perecivel ou não.");
                    return false;
                }

                return true;
            }

            // Valida o caminho do arquivo
            function validateDescartavel() {
                var descartavel = document.getElementById("descartavel").value;

                if (descartavel === "") {
                    alert("Deve ser informado se o produto é descartavel ou não");
                    return false;
                }
                return true;
            }
            // Valida os dados do formulário
            function validateForm() {
                return validateNome() && validateMarca() && validatePerecivel() && validateDescartavel() ;
            }
        </script>
</body>
</html>