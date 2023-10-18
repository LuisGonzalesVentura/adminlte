
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
                <a href="<?php echo base_url();?>/listaeditarusuarios"  class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editar</p>
                </a>
              </li>
              <li class="nav-item" id="crearUsuarios">
                <a href="<?php echo base_url();?>/crearusuario"  class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear</p>
                </a>
              </li>
              <li class="nav-item" id="eliminarUsuarios">
                <a href="<?php echo base_url('EliminarUsuarios/eliminarusuario');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Eliminar</p>
                </a>
              </li>
              <li class="nav-item"id="desactivarUsuarios">
                <a href="<?php echo base_url('DesactivarUsuario/desactivarusuario');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Desactivar</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item">
            <a href="#" onclick="cerrarSesion();" class ="nav-link">
              <i class="fas fa-sign-out-alt text-danger"></i>
              <p>Salir</p>
             </a>
            </li>
      </nav>

      <script type="text/javascript">
  function cerrarSesion() {
    swal.fire({
      title: '¿Desea salir?',
      text: 'La sesión terminará.',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, Salir'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?php echo base_url('Login/cerrarSesion');?>";
      }
    });
  }
</script>


      <?=$this->endSection(); ?>


      <section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <img src="<?php echo ''?>/dist/img/LogoDNI.png" alt="Imagen" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</section>



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


