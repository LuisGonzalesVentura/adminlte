
<?=$this->extend('Views/Dashboard/plantilla'); ?>



<?= $this->section('menu'); ?>
<!-- Sidebar Menu -->

<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item"id="menuAdministracion">
            <a href="#" class="nav-link" >
            <i class="ri-user-fill"></i>
              <p>
              Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" id="menuUsuarios">
                <a href="<?php echo 'http://localhost/adminlte/public'?>/listaeditarusuarios"  class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editar</p>
                </a>
              </li>
              <li class="nav-item" id="crearUsuarios">
                <a href="<?php echo 'http://localhost/adminlte/public'?>/crearusuario"  class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear</p>
                </a>
              </li>
              <li class="nav-item" id="eliminarUsuarios">
                <a href="<?php echo 'http://localhost/adminlte/public'?>/listaborrarusuarios" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Eliminar</p>
                </a>
              </li>
              <li class="nav-item"id="desactivarUsuarios">
                <a href="<?php echo 'http://localhost/adminlte/public'?>/listadesactivarusuarios" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Desactivar</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item">
            <a href="  <?php  echo  base_url();?>Login" class ="nav-link">
              <i class="fas fa-sign-out-alt text-danger"></i>
              <p>Salir</p>
             </a>
            </li>
      </nav>
      <!-- /.sidebar-menu -->
      <?=$this->endSection(); ?>


      


    <?=$this->section('folder'); ?>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2023 <a href="https://www.dni-bolivia.org.bo/">DNI-Bolivia.org</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<?=$this->endSection(); ?>


