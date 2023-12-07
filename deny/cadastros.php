<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Produto</title>
</head>
<body>
  
  <!--Form NULO, apenas para selecionar a opção de cadastro-->
  <script src="../assets/js/register_option.js"></script>
  <form action="#">
    <input type="radio" id="produto"    name="cadastrar"  value="1" onclick="option_register()">
    <label for="option">novo produto</label><br>
    
    <input type="radio" id="fornecedor" name="cadastrar"  value="2" onclick="option_register()">
    <label for="option">novo fornecedor</label><br>
    
    <input type="radio" id="local"      name="cadastrar"  value="3" onclick="option_register()">
    <label for="option">novo local</label><br>
  </form>
  
  <br><br>
  
  
  <div id="form-local" style="display: none">
    <form action="#" method="post">
      <input type="text">
      <input type="text">
      
      <input type="submit">
    </form>
  </div>
  
  
  
  
  <div id="form-fornecedor" style="display: none">
    <input type="radio" id="completo" name="option_forn" value="1">
    <input type="radio" id="representante" name="option_forn" value="2">
    
    <form action="#" method="post">
      <input type="text" placeholder="EMPRESA"><br>           <!-- empresa -->
      <input type="email" placeholder="E-MAIL"><br>           <!-- e-mail -->
      <input type="text" placeholder="TELEFONE"><br>          <!-- telefone -->
      
      <select id="" name="">
        <option value=""></option>
        
      </select>
      <input type="text">
      
      
      
      <input type="text">
      
      
      <input type="submit">
    </form>
  </div>
  
  
  
  <!-- Form de cadastro para produto -->
  
  <!-- Biblioteca estatica do JS para lidar com diversas formatações de data -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="../assets/js/input_validade.js"></script>
  <script src="../assets/js/input_perecivel.js"></script>
  

  <div id="form-produto" style="display: none">
    <form id="form-cad-produto" action="../app/controller/controller_product.php" method="post">
      <input type="text" required placeholder="NOME" name="nome"><br>                                       <!-- nome -->
      <input type="text" required placeholder="MARCA" name="marca"><br>                                     <!-- marca -->

      <input type="checkbox" name="descartavel" value="true">                                               <!-- descartavel -->
      <label for="booleano">Descartável</label>

      <input id="inp-bool"    type="checkbox" name="perecivel" value="true" onclick="openvalidity()">       <!-- perecivel -->
      <label for="booleano">Perecível</label><br>

      <input id="inp-txt-val" type="date" name="validade" placeholder="VÁLIDADE" style="display: none">     <!-- validade -->
      <input type="number" placeholder="ID local"><br>                                                      <!-- ID local -->
      
      <select id="" name="categoria">                                                                       <!-- categoria -->
        <option value="">Selecione Categoria</option>
      </select><br>
      
      <select id="" name="fornecedor">                                                                      <!-- fornecedor -->
        <option value="">Selecione Fornecedor</option>
      </select><br>

      <input type="submit" value="enviar" onclick="standardize()">
    </form>
  </div>

</body>
</html>