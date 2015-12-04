<div class="ls-topbar ">

  <!-- Barra -->
  <div class="ls-notification-topbar">

    <!-- Dropdown com detalhes da conta -->
    <div data-ls-module="dropdown" class="ls-dropdown ls-user-account acc">
      <a href="#" class="ls-ico-user">
        <!-- <img src="images/locastyle/avatar-example.jpg" alt="" /> -->
        <span class="ls-name" style="text-transform:uppercase;"><?php echo $userLogin['nome']; ?></span>
      </a>

      <nav class="ls-dropdown-nav ls-user-menu">
        <ul>
          <li><a href="perfil.php">Perfil</a></li>
          <li><a href="logout.php">Sair</a></li>
         </ul>
      </nav>
    </div>
  </div>

  <span class="ls-show-sidebar ls-ico-menu"></span>

  <!-- Nome do produto/marca com sidebar -->
    <h1 class="ls-brand-name">
      <a href="painel.php" class="ls-ico-cog">
        <small>Painel do administrador</small>
        RIIFBA
      </a>
    </h1>

  <!-- Nome do produto/marca sem sidebar quando for o pre-painel  -->
</div>