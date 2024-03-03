<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Título dinâmico -->
  <title>
    <?= isset($title) ? $title : "SGA" ?>
  </title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../../vendor/adminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../vendor/adminLTE-3.2.0/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="resources/css/custom.css">
</head>

<body>
  <!-- Navbar -->
  <?php isset($navbar) && $navbar === true ? include_once "navbar.php" : null ?>
  <!-- Inicio do body -->
  <main class="vh-100 mt-5 mx-5">