<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
  
    <ul class="sidebar-menu">
      
      <!-- Inicio -->
      <li>
        <a href="http://localhost/clinica/inicio">
          <i class="fa fa-home"></i>
          <span>Inicio</span>
        </a>
      </li>

      <!-- Consultorios -->
      <li>
        <a href="http://localhost/clinica/Ver-consultorios">
          <i class="fa fa-medkit"></i>
          <span>Consultorios</span>
        </a>
      </li>

      <!-- Historial -->
      <li>
        <?php
          // Link dinámico para historial del paciente según su sesión
          echo '<a href="http://localhost/clinica/historial/' . htmlspecialchars($_SESSION["id"]) . '">';
        ?>
          <i class="fa fa-calendar-check-o"></i>
          <span>Historial</span>
        </a>
      </li>

      <!-- NUEVO: Documentos Médicos -->
      <li>
        <?php
          // Link dinámico para documentos del paciente según su sesión
          echo '<a href="http://localhost/clinica/documentosP/' . htmlspecialchars($_SESSION["id"]) . '">';
        ?>
          <i class="fa fa-file-text-o"></i>
          <span>Mis Documentos</span>
        </a>
      </li>

    </ul>

  </section>
  <!-- /.sidebar -->
</aside>
