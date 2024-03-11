<!-- CONFIGURAÇÃO DA VIEW -->
<?php
$active = "lotes";  // CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGINA ATUAL
$navbar = true;    // CONFIGURA A APARIÇÃO DA NAVBAR NESTA PÁGINA ESPECÍFICA
$footer = true;    // CONFIGURA A APARIÇÃO DO FOOTER NESTA PÁGINA ESPECÍFICA
?>

<?php include "app/view/components/head.php" ?>
<!-- BREADCRUMB -->
<div class="d-flex flex-column">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active"><a href="/lotes">Lotes</a>
        </li>
        <li class="breadcrumb-item active">Visualizar detalhes</li>
    </ol>
    <h1 class="text-md-left text-sm-center pb-3 border-bottom">Visualização de lote</h1>
</div>

<!-- TABELA -->
<div class="table-responsive">
    <table id="datatable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>
                    Data cadastro
                </th>
                <th>
                    Código
                </th>
                <th>
                    Nota relacionada
                </th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>
                    Data cadastro
                </th>
                <th>
                    Código
                </th>
                <th>
                    Nota relacionada
                </th>
            </tr>
        </tfoot>
    </table>
</div>

<!-- AÇOES -->
<a href="index.php?controller=note&action=edit&id=<?php ?>" class="btn btn-primary">Editar</a>
<a href="index.php?controller=note&action=delete&id=<?php ?>" class="btn btn-danger">Excluir</a>


<?php include_once "app/view/components/footer.php" ?>