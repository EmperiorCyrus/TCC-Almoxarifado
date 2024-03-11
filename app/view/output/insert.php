<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de nota fiscal</title>

    <!-- Estilos do AdminLTE -->
    <link rel="stylesheet" href="/sga//vendor/adminlte/dist/css/adminlte.min.css">

    <!-- Bootstrap CSS (opcional, se necessário) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cadastro de nota fiscal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="index.php?controller=ControllerProduct&action=index">Produtos</a></li>
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
                            <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" placeholder="Insira a data da saida." required>
                        </div>
                        <div class="form-group">
                            <label for="quantidade">Quantidade</label>
                            <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Insira a quantidade da saida.">
                        </div>
                        <button type="submit" onclick="return validateForm()" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Scripts do AdminLTE e outros scripts (opcional) -->
    <script src="caminho/para/adminlte/3.2.0/js/adminlte.min.js"></script>
    <!-- Outros scripts que você pode precisar -->
</body>
</html>
