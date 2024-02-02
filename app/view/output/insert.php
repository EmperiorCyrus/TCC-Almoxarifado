<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cadastro de nota fiscal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active"><a
                            href="index.php?controller=ControllerProduct&action=index">Produtos</a></li>
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
                <h3 class="card-title">Formulário de registro de nota fiscal.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

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
            <!-- /.card-body -->

        </div>
        <!-- /.card -->

        <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

        <div class="container">
            <h1>Saida</h1>
            
        </div>
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
