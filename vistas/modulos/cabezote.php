  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contacto</a>
      </li>
      <li>
        <pre><?php 
        // el usuario debe salir y volver a entrar para recargar todos los permisos
        // print_r($_SESSION["permisos"]); 
        ?></pre>
      </li>
    </ul>

      <?php
    $usuarioId = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : null;
    $totalNoLeidas = 0;
    if ($usuarioId) {
        $notificacionesNoLeidas = ControladorNotificaciones::listarNoLeidas($usuarioId);
        $totalNoLeidas = !empty($notificacionesNoLeidas) ? count($notificacionesNoLeidas) : 0;
    }
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="notificaciones">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="count-notificaciones"><?php echo $totalNoLeidas; ?></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <!-- user dropdown logout -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="salir" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Finalizar Sesión
          </a>
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->