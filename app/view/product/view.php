<!-- CONFIGURAÇÃO DA VIEW -->
<?php
$active = "notas";  // CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGINA ATUAL
$navbar = true;    // CONFIGURA A APARIÇÃO DA NAVBAR NESTA PÁGINA ESPECÍFICA
$footer = true;    // CONFIGURA A APARIÇÃO DO FOOTER NESTA PÁGINA ESPECÍFICA
?>

<?php include "app/view/components/head.php" ?>
<!-- BREADCRUMB -->
<div class="d-flex flex-column">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active"><a href="index.php?controller=ControllerInvoice&action=index">Produtos</a>
        </li>
        <li class="breadcrumb-item active">Visualizar detalhes</li>
    </ol>
    <h1 class="text-md-left text-sm-center pb-3 border-bottom">Visualização de produto</h1>
</div>

<!-- TABELA -->
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
                    Descartavel
                </th>
            </tr>
        </thead>
        <tbody>

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
                    Descartavel
                </th>
            </tr>
        </tfoot>
    </table>
</div>

<!-- AÇOES -->
<a href="index.php?controller=note&action=edit&id=<?php ?>" class="btn btn-primary">Editar</a>
<a href="index.php?controller=note&action=delete&id=<?php ?>" class="btn btn-danger">Excluir</a>


<?php include_once "app/view/components/footer.php" ?>