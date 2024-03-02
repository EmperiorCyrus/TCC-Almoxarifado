<?php $active = "perfil" ?> <!-- CONFIGURA O ESTADO ATIVO DA NAVBAR COM BASE NA PÁGIAN ATUAL -->
<?php include_once "components/head.php" ?>
<div class="d-flex flex-column">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Perfil</li>
  </ol>
  <h1 class="text-md-left text-sm-center pb-3 border-bottom">Perfil</h1>
</div>

<div class="row mt-4">
  <div class="col-5 col-sm-3">
    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab"
        aria-controls="vert-tabs-home" aria-selected="true">Perfil</a>
      <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab"
        aria-controls="vert-tabs-profile" aria-selected="false">Mudar email</a>
      <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab"
        aria-controls="vert-tabs-messages" aria-selected="false">Mudar senha</a>
      <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab"
        aria-controls="vert-tabs-settings" aria-selected="false">Configurações</a>
    </div>
  </div>
  <div class="col-7 col-sm-9">
    <div class="tab-content" id="vert-tabs-tabContent">
      <!-- Uma aba -->
      <div class="tab-pane text-left fade active show" id="vert-tabs-home" role="tabpanel"
        aria-labelledby="vert-tabs-home-tab">
        <!-- User name -->
        <h2 class="text-xl">
          <?= isset($name) ? $name : "Nome do usuário" ?>
        </h2>
        <div class="d-felx flex-column">
          <div>
            <!-- User email -->
            <label for="email">Email</label>
            <input type="text" class="form-control mb-3" value="<?= isset($email) ? $email : "Email" ?>" disabled
              id="email">
          </div>
          <div>
            <!-- User password -->
            <label for="password">Password</label>
            <input type="password" class="form-control" value="<?= isset($password) ? $password : "Password" ?>"
              disabled id="password">
          </div>
        </div>
      </div>
      <!-- Mudar email -->
      <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
        <h2 class="text-xl text-capitalize border-bottom pb-3">Mudar email</h2>
        <form action="" method="post">
          <div>
            <label for="email-atual">Email atual</label>
            <input type="email" class="form-control mb-3" placeholder="Email..." id="email-atual" name="emailAtual"
              required>
          </div>
          <div>
            <label for="email-novo">Novo email</label>
            <input type="email" class="form-control mb-3" placeholder="Email..." id="email-novo" name="novoEmail"
              required>
          </div>
          <button type="submit" class="btn btn-outline-primary">Mudar email</button>
        </form>
      </div>
      <!-- Mudar senha -->
      <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
        <h2 class="text-xl text-capitalize border-bottom pb-3">Mudar senha</h2>
        <form action="" method="post">
          <div>
            <label for="email-novo">Nova senha</label>
            <input type="password" class="form-control mb-3" placeholder="Senha..." id="senha-nova" name="senhaNova"
              required>
          </div>
          <div>
            <label for="email-novo">Confirme nova senha</label>
            <input type="password" class="form-control mb-3" placeholder="Senha..." id="senha-nova-confirmar"
              name="senhaNovaConfirmar" required>
          </div>
          <button type="submit" class="btn btn-outline-primary">Mudar senha</button>
        </form>
      </div>
      <!-- Configurações -->
      <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales
        tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique.
        Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget
        dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac
        habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
      </div>
    </div>
  </div>
</div>
<?php include_once "components/footer.php" ?>