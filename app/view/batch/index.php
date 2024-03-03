<!-- CONFIGURAÇÃO DA VIEW -->
<?php
$active = "notas";  // CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGINA ATUAL
$navbar = true;    // CONFIGURA A APARIÇÃO DA NAVBAR NESTA PÁGINA ESPECÍFICA
$footer = true;    // CONFIGURA A APARIÇÃO DO FOOTER NESTA PÁGINA ESPECÍFICA
?>

<?php include "app/view/components/head.php" ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- BREADCRUMB -->
        <div class="d-flex flex-column">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Lotes</li>
            </ol>
            <h1 class="mb-4">Lista de lote(s)</h1>
        </div>

        <!-- Botão de cadastrar -->
        <div class="d-flex justify-content-start">
            <!-- TODO: MUDAR O LINK DESSE BOTÃO PARA O LUGAR QUE CRIA NOTAS -->
            <button type="button" onclick="window.location.href='/'" class="btn btn-success mb-4">Cadastrar</button>
        </div>

        <!-- Tabela -->
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            Data registro
                        </th>
                        <th>
                            Código
                        </th>
                        <th>
                            Nota relacionada
                        </th>
                        <th>
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <thead>
                        <tr>
                            <th>
                                Data registro
                            </th>
                            <th>
                                Código
                            </th>
                            <th>
                                Nota relacionada
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