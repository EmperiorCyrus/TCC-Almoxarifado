<!-- CONFIGURAÇÃO DA VIEW -->
<?php
$active = "produtos";  // CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGINA ATUAL
$navbar = true;    // CONFIGURA A APARIÇÃO DA NAVBAR NESTA PÁGINA ESPECÍFICA
$footer = true;    // CONFIGURA A APARIÇÃO DO FOOTER NESTA PÁGINA ESPECÍFICA

// print_r($produtos);
?>

<?php include "app/view/components/head.php" ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- BREADCRUMB -->
        <div class="d-flex flex-column">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Início</a></li>
                <li class="breadcrumb-item active">Produtos</li>
            </ol>
            <h1 class="mb-4">Lista de produto(s)</h1>
        </div>

        <!-- Botão de cadastrar -->
        <div class="d-flex justify-content-start">
            <!-- TODO: MUDAR O LINK DESSE BOTÃO PARA O LUGAR QUE CRIA NOTAS -->
            <button type="button" onclick="window.location.href='/produtos/criar'" class="btn btn-success mb-4">Cadastrar</button>
        </div>

        <!-- Tabela -->
        <div class="table-responsive">
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
                            Perecível
                        </th>
                        <th>
                            Descartável
                        </th>
                        <th>
                            Validade
                        </th>
                        <th>
                            Data registro
                        </th>
                        <th>
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($produtos as $produto) {
                        ?>
                        <tr>
                            <td>
                                <?= $produto['name'] ?>
                            </td>
                            <td>
                                <?= $produto['brand'] ?>
                            </td>
                            <td>
                                <?= $produto['perishable'] ?>
                            </td>
                            <td>
                                <?= $produto['disposable'] ?>
                            </td>
                            <td>
                                <?= $produto['validity'] ?>
                            </td>
                            <td>
                                <?= $produto['creation_date'] ?>
                            </td>
                            <td>
                                <a href="#"
                                    class="btn btn-primary">Editar</a>
                                <a href="#"
                                    class="btn btn-danger">Excluir</a>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            Nome
                        </th>
                        <th>
                            Marca
                        </th>
                        <th>
                            Perecível
                        </th>
                        <th>
                            Descartável
                        </th>
                        <th>
                            Validade
                        </th>
                        <th>
                            Data registro
                        </th>
                        <th>
                            Ações
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include "app/view/components/footer.php" ?>