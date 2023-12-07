<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Nota Fiscal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Nota Fiscal</h1>
        <form action="../../controller/index.php?controller=ControllerInvoice&action=save" method="get">
            <input type="hidden" nome="controller" value="ControllerInvoice">
            <input type="hidden" nome="action" value="save">
            <div class="form-group">
                <label for="name">Numero</label>                
                <input type="text" class="form-control" id="numero" name="numero" required>
                <p class="form-text text-muted">O numero da nota fiscal facilitará busca futuras. Por isso este campo é *obrigatório.</p>
            </div>
            <div class="form-group">
                <label for="path">Arquivo</label>
                <input type="file" class="form-control" id="path" name="path" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <button type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
        </form>
        <script>
            // Valida o nome da nota fiscal
            function validateNumero() {
                var numero = document.getElementById("numero").value;

                if (numero === "") {
                    alert("O numero da nota fiscal deve ser preenchido.");
                    return false;
                }

                return true;
            }

            // Valida o caminho do arquivo
            function validatePath() {
                var path = document.getElementById("path").value;

                if (path === "") {
                    alert("Você deve fazer upload do arquivo referente a nota.");
                    return false;
                }
                return true;
            }

            // Valida a descricao da nota fiscal 
            function validateDescription() {
                var description = document.getElementById("description").value;

                if (description === "") {
                    alert("A descrição da nota fiscal deve ser preenchida.");
                    return false;
                }
                return true;
            } 

            // Valida os dados do formulário
            function validateForm() {
                return validateNumero() && validatePath() && validateDescription();
            }
        </script>
    </div>
</body>
</html>