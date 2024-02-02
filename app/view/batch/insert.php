<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cadastro de lote</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active"><a href="index.php?controller=ControllerBatch&action=index">Lista
                            de lotes</a></li>
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
                <h3 class="card-title">Formulário de registro de novo lote.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="index.php?controller=ControllerBath&action=save" method="post">
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
                        <input type="text" class="form-control" id="id_nota" name="id_nota" placeholder="ID DA NOTA"
                            required>
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

        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

    <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->