<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de entrada(s)</title>

    <!-- Estilos do AdminLTE -->
    <link rel="stylesheet" href="caminho/para/adminlte/3.2.0/css/adminlte.min.css">

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
                    <h1 class="m-0">Lista de entrada(s)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lista de entrada</li>
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
                    <h3 class="card-title"></h3>
                    <button type="button" onclick="window.location.href='index.php?controller=ControllerEntrance&action=insert'" class="btn btn-block btn-success">Cadastrar</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Validade</th>
                                <th>Valor</th>
                                <th>Data de registro</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Internet Explorer 4.0</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>
                                    <a href="index.php?controller=ControllerEntrance&action=edit&id=<?php ?>" class="btn btn-primary">Editar</a>
                                    <a href="index.php?controller=ControllerEntrance&action=delete&id=<?php ?>" class="btn btn-danger">Excluir</a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Validade</th>
                                <th>Valor</th>
                                <th>Data de registro</th>
                                <th>Ação</th>
                            </tr>
                        </tfoot>
                    </table>
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
