
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
                            href="index.php?controller=ControllerInvoice&action=index">Notas fiscais</a></li>
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

                <form action="index.php?controller=ControllerInvoice&action=save" method="post" enctype="multipart/form-data">
                    <input type="hidden" nome="controller" value="ControllerInvoice">
                    <input type="hidden" nome="action" value="save">
                    <!-- MAX_FILE_SIZE deve preceder o campo input -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                    <div class="form-group">
                        <label for="name">Numero</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                        <p class="form-text text-muted">O numero da nota fiscal facilitará busca futuras. Por isso este
                            campo é
                            *obrigatório.</p>
                    </div>
                    <div class="form-group">
                        <label for="path">Arquivo</label>

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="path" name="path" required>
                                <label class="custom-file-label" for="exampleInputFile">Selecionar arquivo</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="form-group">                        
                        <button type="submit" onclick="validateForm()" class="btn btn-primary col-md-3 col-sm-6 col-12">Cadastrar</button>
                    </div>
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

                    <?php
                        if (isset($_SESSION['app/view/note/insert']['sucess'])){                        
                    ?>
                        alert('<?= $_SESSION['app/view/note/insert']['sucess']; ?>');
                    <?php
                        }
                        unset($_SESSION['app/view/note/insert']);
                    ?>
                </script>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->

        <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->