<!-- CONFIGURAÇÃO DA VIEW -->
<?php
$active = "saidas";  // CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGINA ATUAL
$navbar = true;    // CONFIGURA A APARIÇÃO DA NAVBAR NESTA PÁGINA ESPECÍFICA
$footer = true;    // CONFIGURA A APARIÇÃO DO FOOTER NESTA PÁGINA ESPECÍFICA
?>

<?php include "app/view/components/head.php" ?>
<!-- BREADCRUMB -->
<div class="d-flex flex-column">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active"><a href="/saidas">Saídas</a></li>
        <li class="breadcrumb-item active">Registrar</li>
    </ol>
    <h1 class="text-md-left text-sm-center pb-3 border-bottom">Registro de saída</h1>
</div>

<!-- Main content -->
<section class="content mx-auto mt-4">
    <div class="container-fluid w-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulário de registro de saídas.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form action="index.php?controller=lote&action=save" method="post">
                    <div class="form-group">
                        <label for="data_cadastro">Data Cadastro</label>
                        <input type="date" class="form-control" id="data_cadastro" name="data_cadastro"
                            placeholder="Insira a data da saida." required>
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="text" class="form-control" id="quantidade" name="quantidade"
                            placeholder="Insira a quantidade da saida.">
                    </div>
                    <div class="text-center">
                        <button type="submit" onclick="validateForm()"
                            class="btn btn-outline-success w-100">Cadastrar</button>
                    </div>
                </form>
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
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<!-- <div class="container">
    <h1>Saida</h1>

</div> -->
<!-- <script>
            
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
        </script> -->
<?php include "app/view/components/footer.php" ?>