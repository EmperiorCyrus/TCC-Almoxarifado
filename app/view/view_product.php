<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>

    <!-- Estilos do AdminLTE -->
  <link rel="stylesheet" href="/sga//vendor/adminlte/dist/css/adminlte.min.css">

    <!-- Bootstrap CSS (opcional, se necessário) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Produtos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lista de Produtos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="#" method="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Pesquisar">
                            <select name="filtro-opcao" class="form-control" required>
                                <option value="">- Campo -</option>
                                <option value="nome">Nome</option>
                                <option value="marca">Marca</option>
                                <option value="fornecedor">Fornecedor</option>
                                <option value="categoria">Categoria</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Marca</th>
                                            <th>Fornecedor</th>
                                            <th>Categoria</th>
                                            <th>Armazem</th>
                                            <th>Preço Un.</th>
                                            <th>Preço Total</th>
                                            <th>Descartável</th>
                                            <th>Perecivel</th>
                                            <th>Validade</th>
                                            <th>Data Criação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $info->show_all_product();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Scripts do AdminLTE e outros scripts (opcional) -->
    <script src="caminho/para/adminlte/3.2.0/js/adminlte.min.js"></script>
    <!-- Outros scripts que você pode precisar -->
</body>
</html>
