<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">

  <a class="navbar-brand" href="#"> SGA </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?= $active === 'home' ? 'active' : '' ?>">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item <?= $active === 'produtos' ? 'active' : '' ?>">
        <a class="nav-link" href="/produtos">Produtos</a>
      </li>
      <li class="nav-item <?= $active === 'notas' ? 'active' : '' ?>">
        <a class="nav-link" href="/notas">Notas</a>
      </li>
      <li class="nav-item <?= $active === 'perfil' ? 'active' : '' ?>">
        <a class="nav-link" href="/perfil">Perfil</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="btn btn-danger" href="#">Log-out</a>
      </li>
    </ul>

  </div>

</nav>
<!-- /.navbar -->