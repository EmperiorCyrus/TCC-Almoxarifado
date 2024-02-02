<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Visualizar Nota Fiscal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Visualizar Nota Fiscal</h1>
        <table class="table table-bordered">
            <tr>
                <th>Nome</th>
                <td><?php ?></td>
            </tr>
            <tr>
                <th>Path</th>
                <td><?php ?></td>
            </tr>
            <tr>
                <th>Descrição</th>
                <td><?php ?></td>
            </tr>
            <tr>
                <th>Data de criação</th>
                <td><?php ?></td>
            </tr>
        </table>
        <a href="index.php?controller=note&action=edit&id=<?php ?>" class="btn btn-primary">Editar</a>
        <a href="index.php?controller=note&action=delete&id=<?php ?>" class="btn btn-danger">Excluir</a>
    </div>
</body>
</html>