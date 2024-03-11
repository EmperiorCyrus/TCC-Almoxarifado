<!-- CONFIGURAÇÃO DA VIEW -->
<?php
$active = "produtos";  // CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGINA ATUAL
$navbar = true;    // CONFIGURA A APARIÇÃO DA NAVBAR NESTA PÁGINA ESPECÍFICA
$footer = true;    // CONFIGURA A APARIÇÃO DO FOOTER NESTA PÁGINA ESPECÍFICA
?>

<?php include "app/view/components/head.php" ?>
<!-- BREADCRUMB -->
<div class="d-flex flex-column">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active"><a href="/produtos">Produtos</a>
        </li>
        <li class="breadcrumb-item active">Cadastrar</li>
    </ol>
    <h1 class="text-md-left text-sm-center pb-3 border-bottom">Cadastro de produto</h1>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulário de registro de produtos.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form action="index.php?controller=lote&action=save" method="post">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome"
                            placeholder="Insira o nome do produto" required>
                    </div>
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca"
                            placeholder="Insira a marca do produto ">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-check-inline" id="perecivel" name="perecivel"
                            placeholder="Informe se o produto é perecivel" onchange="showDataValidade()">
                        <label for="perecivel">Perecivel</label>
                        <input type="date" class="form-control d-none" id="dataValidade" name="dataValidade"
                            placeholder="Informe a data de validade" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-check-inline" id="descartavel" name="descartavel"
                            placeholder="Informe se o produto é descartavel">
                        <label for="descartavel">Descartavel</label>
                    </div>
                    <button type="submit" onclick="validateForm()" class="btn btn-primary">Cadastrar</button>
                </form>
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
                        return validateNome() && validateMarca() && validatePerecivel() && validateDescartavel();
                    }

                    function showDataValidade() {
                        const perecivelInputCheckbox = document.getElementById("perecivel");
                        const dataValidadeInput = document.getElementById("dataValidade");

                        dataValidadeInput.classList.toggle("d-none");

                        if (perecivelInputCheckbox.checked) {
                            dataValidadeInput.setAttribute("required", "true");
                        } else {
                            dataValidadeInput.setAttribute("required", "false");
                        }

                    }
                </script>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->

        <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->












<!-- 
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
        </script> -->
<?php include "app/view/components/footer.php" ?>