<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de nota(s)</title>

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
                    <h1 class="m-0">Lista de nota(s)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Notas Fiscais</li>
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
                    <button type="button" onclick="window.location.href='index.php?controller=ControllerInvoice&action=insert'" class="btn btn-block btn-success">Cadastrar</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Numero</th>
                                <th>Descrição</th>
                                <th>Arquivo</th>
                                <th>Data de registro</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notes as $note): ?>
                                <tr>
                                    <td><?= $note->getName(); ?></td>
                                    <td><?= $note->getNumero(); ?></td>
                                    <td><?= $note->getDescription(); ?></td>
                                    <td><a href="<?= $note->getPath(); ?>" target="_blank">Arquivo</a></td>
                                    <td><?= $note->getCreation_date(); ?></td>
                                    <td>
                                        <a href="index.php?controller=ControllerInvoice&action=edit&id=<?= $note->getIdinvoice(); ?>" class="btn btn-primary">Editar</a>
                                        <a href="index.php?controller=ControllerInvoice&action=delete&id=<?= $note->getIdinvoice(); ?>" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Numero</th>
                                <th>Descrição</th>
                                <th>Arquivo</th>
                                <th>Data de registro</th>
                                <th>Ações</th>
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
</body>
</html>
