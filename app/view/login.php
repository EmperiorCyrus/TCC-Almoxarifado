<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Cadastro</title>

  <!-- Estilos do AdminLTE -->
  <link rel="stylesheet" href="/sga//vendor/adminlte/dist/css/adminlte.min.css">

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/sga/assets/css/for-login.css">

  <!-- Scripts -->
  <script src="/sga/assets/js/button_login.js"></script>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <!--<img src="assets/img/senai-logo-0.png" alt="senai"> -->
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><b>LOGIN</b></p>
        <form action="#" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="E-MAIL" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="SENHA" name="senha" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">ENTRAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
