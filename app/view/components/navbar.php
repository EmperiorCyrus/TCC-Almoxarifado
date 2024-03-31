<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">

  <a class="navbar-brand" href="#"> S.G.A </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?= $active === 'home' ? 'active' : '' ?>">
        <a class="nav-link" href="/">
          <i class="bi bi-house-fill"></i>
          Início
        </a>
      </li>
      <li class="nav-item <?= $active === 'produtos' ? 'active' : '' ?>">
        <a class="nav-link" href="/produtos">
        <i class="bi bi-bag-fill pr-1"></i>  
        Produtos
      </a>
      </li>
      <li class="nav-item <?= $active === 'notas' ? 'active' : '' ?>">
        <a class="nav-link" href="/notas">
        <i class="bi bi-sticky-fill pr-1"></i>  
        Notas
      </a>
      </li>
      <li class="nav-item <?= $active === 'lotes' ? 'active' : '' ?>">
        <a class="nav-link" href="/lotes">
        <i class="bi bi-box-seam-fill pr-1"></i>  
        Lotes
      </a>
      </li>
      <li class="nav-item <?= $active === 'entradas' ? 'active' : '' ?>">
        <a class="nav-link" href="/entradas">
        <i class="bi bi-door-open-fill pr-1"></i>  
        Entradas
      </a>
      </li>
      <li class="nav-item <?= $active === 'saidas' ? 'active' : '' ?>">
        <a class="nav-link" href="/saidas">
        <i class="bi bi-door-closed-fill pr-1"></i>  
        Saídas
      </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item <?= $active === 'saidas' ? 'active' : '' ?>">
        <a class="nav-link" href="/perfil">
          <i class="bi bi-person-fill pr-1"></i>
          Perfil
        </a>
      </li>
      <li class="nav-item">
        <a class="btn btn-danger" href="/logout">
          <i class="bi bi-box-arrow-left pr-2"></i>
          Sair
        </a>
      </li>
    </ul>

  </div>

</nav>
<!-- /.navbar -->