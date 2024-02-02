<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Lista de Produto(s)</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Lista de Produtos</li>
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
                <button type="button"
                    onclick="window.location.href='index.php?controller=ControllerProduct&action=insert'"
                    class="btn btn-block btn-success">Cadastrar</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Nome
                            </th>
                            <th>
                                Marca
                            </th>
                            <th>
                                Perecivel
                            </th>
                            <th>
                                Descartavel
                            </th>
                            <th>
                                Validade
                            </th>
                            <th>
                                Data Registro
                            </th>
                            <th>
                                Ação
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Trident
                            </td>
                            <td>
                                Internet
                            </td>
                            <td>
                                Win 95+
                            </td>
                            <td>
                                4
                            </td>
                            <td>
                                4
                            </td>
                            <td>
                                4
                            </td>
                            <td>
                                <a href="index.php?controller=ControllerProduct&action=edit&id=<?php ?>"
                                    class="btn btn-primary">Editar</a>
                                <a href="index.php?controller=ControllerProduct&action=delete&id=<?php ?>"
                                    class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->

        <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->