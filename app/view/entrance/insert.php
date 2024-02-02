<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cadastro de entrada
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active"><a href="index.php?controller=ControllerBatch&action=index">Lista
                            de entradas</a></li>
                    <li class="breadcrumb-item active">Cadastrar</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulário de registro de nova entrada</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="index.php?controller=ControllerEntrance&action=save" method="post">
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="text" class="form-control" id="quantidade" name="quantidade"
                            placeholder="Insira a quantidade do produto." required>
                    </div>
                    <div class="form-group">
                        <label for="validade">Validade</label>
                        <input type="text" class="form-control" id="validade" name="validade"
                            placeholder="Insira a validade do produto.">
                    </div>
                    <div class="form-group">
                        <label for="perecivel">Valor</label>
                        <input type="valor" class="form-control" id="valor" name="valor"
                            placeholder="Insira o valor do produto." required>
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

        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

    <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
<!-- <div class="container">
    <h1>Entrada</h1>
    <form action="index.php?controller=lote&action=save" method="post">
        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="text" class="form-control" id="quantidade" name="quantidade"
                placeholder="Insira a quantidade do produto." required>
        </div>
        <div class="form-group">
            <label for="validade">Validade</label>
            <input type="text" class="form-control" id="validade" name="validade"
                placeholder="Insira a validade do produto.">
        </div>
        <div class="form-group">
            <label for="perecivel">Valor</label>
            <input type="valor" class="form-control" id="valor" name="valor" placeholder="Insira o valor do produto."
                required>
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
</script> -->