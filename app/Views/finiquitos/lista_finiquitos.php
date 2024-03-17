<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<?= $this->extend('Views/Dashboard/escritorio'); ?>


<?= $this->section('contenido'); ?>

  <link rel="icon" type="image/png" href="LogoDNI.png" />

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Listado de contratos</li>
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
   <!-- ... Otro contenido HTML ... -->
<!-- ... Otro contenido HTML ... -->

<!-- Tabla de Finiquitos -->
<table id="tablaFiniquitos" class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Carnet</th>
            <th>Empleado</th>
            <th>Archivo</th>
            <th>Fecha Finiquito</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        
<!-- SidebarSearch Form -->
<div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" id="searchInput" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar" id="searchButton">
                <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
    </div>
    <div class="card-footer">
    <div>
        <?= anchor(base_url('finiquito/listar_finiquitos'), 'Ir a Lista de Finiquitos', ['class' => 'btn btn-primary']); ?>
    </div>
</div>

   
                            </div>


        <?php foreach ($finiquitos as $finiquito): ?>
            <tr>
                <td><?= esc($finiquito['carnet_empleado']); ?></td>
                <td><?= esc($finiquito['nombre_empleado']); ?></td>
                <td>
                    <?php if ($finiquito['archivo_f']): ?>
                        <a href="<?= base_url('pdfsfiniquitos/' . $finiquito['archivo_f']); ?>" target="_blank"><?= esc('Abrir archivo'); ?></a>
                    <?php else: ?>
                        Sin archivo
                    <?php endif; ?>
                </td>
                <td><?= esc($finiquito['fecha_de_finiquito_f']); ?></td>
               <!-- <td><?= esc($finiquito['fecha_modificacion_finiquito_f']); ?></td>-->
               <!-- <td><?= esc($finiquito['nombre_usuario'] . ' ' . $finiquito['apellido_usuario']); ?></td>-->
                <td>

                <a href="<?= base_url('finiquito/vista_formulario_edicion_finiquito/' . $finiquito['id_finiquito_f']) ?>" class="btn btn-success" type="button">Editar Finiquito</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<!-- ... Otro contenido HTML ... -->

<script type="text/javascript">
    $(document).ready(function () {
        // Agrega un evento al botón de búsqueda
        $("#searchButton").on("click", function () {
            // Obtiene el valor de búsqueda
            var searchText = $("#searchInput").val().toLowerCase();

            // Filtra las filas de la tabla según el valor de búsqueda
            var foundElements = $("#tablaFiniquitos tbody tr").filter(function () {
                return $(this).text().toLowerCase().indexOf(searchText) > -1;
            });

            // Oculta todas las filas
            $("#tablaFiniquitos tbody tr").hide();

            // Si se encontraron elementos, muestra solo esos
            if (foundElements.length > 0) {
                foundElements.show();
            } else {
                console.log("No se encontraron elementos.");
            }

            // Evita que el formulario se envíe (si este es un botón dentro de un formulario)
            return false;
        });

        // Agrega clases a menú
        $("#menufiniquito").addClass("menu-open");
        $("#lista_finiquito").addClass("active");
    });
</script>

  <?= $this->endSection(); ?>