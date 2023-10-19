<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<?= $this->extend('Views/Dashboard/escritorio'); ?>


<?= $this->section('contenido'); ?>


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?= $titulo; ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Formulario Desactivar Usuarios</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <table class="table table-light">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>correo</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php

              use App\Models\Usuario; ?>
              <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                  <?php
                  $user = new Usuario();
                  $id = $usuario['Idusuario'];
                  $datosuser = $user->where('Idusuario', $id)->first();
                  ?>
                  <td><?php echo $usuario['Idusuario']; ?></td>
                  <td><?php echo $usuario['email']; ?></td>
                  <td><?php echo $usuario['usuario']; ?></td>
                  <td><?php echo $usuario['nombre']; ?></td>
                  <td><?php echo $usuario['apellido']; ?></td>
                  <td><a href="<?php echo 'ListaDesactivarUsuarios/desactivar/' . $usuario['Idusuario'] ?>" class="btn 
                  <?php if ($datosuser['estado'] == 'Activo') {
                    echo 'btn-success';
                  } else {
                    echo 'btn-primary';
                  } ?>" type="button">
                      <?php if ($datosuser['estado'] == 'Activo') {
                        echo 'Activo';
                      } else {
                        echo 'Inactivo';
                      } ?></a></td>
                </tr>
                <script>
                  const enlaceEliminar = document.querySelector('a[href="<?php echo 'ListaBorrarUsuarios/borrar/' . $usuario['Idusuario'] ?>"]');
                  enlaceEliminar.addEventListener('click', function(event) {
                    if (!confirm('¿Está seguro de que desea desactivar a este Usuario?')) {
                      event.preventDefault(); // Evita que el enlace se siga si el usuario hace clic en "Cancelar"
                    }
                  });
                </script>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- /.content -->

  <script type="text/javascript">
    $("#menuAdministracion").addClass("menu-open");
    $("#menuUsuarios").addClass("active");
  </script>
  <?= $this->endSection(); ?>