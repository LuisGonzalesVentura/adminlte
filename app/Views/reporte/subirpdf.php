<!-- Add Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>

<link rel="icon" type="image/png" href="LogoDNI.png" />

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
          <li class="breadcrumb-item active">Subir PDFs</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <!-- Main content -->
  
  <div class="container mt-4">
    <div class="form-inline mb-3">
        <!-- Barra de búsqueda -->
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" id="searchInput" type="search" placeholder="Buscar" aria-label="Buscar">
            <div class="input-group-append">
                <button class="btn btn-sidebar" id="searchButton">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>

        <!-- Botón de Lista -->
        <div class="card-footer ml-auto">
            <?= anchor('Reporte/index', '<i class="ri-list-check"></i>', ['class' => 'btn btn-primary']); ?>
        </div>
    </div>

    <!-- Tabla de reportes -->
    <table id="tablaReportes" class="table table-striped">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Nombre(s)</th>
                <th>Nº Carnet</th>
                <th>Oficina</th>
                <th>Tipo</th>
                <th>Subir PDF</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $contador = 1;
            $grupo = "En planillas";

            foreach ($reportes as $reporte) :
            ?>
                <tr>
                    <td><?= $contador; ?></td>
                    <td><?= $reporte->apellido; ?></td>
                    <td><?= $reporte->apellido_materno; ?></td>
                    <td><?= $reporte->nombre; ?></td>
                    <td><?= $reporte->Ci; ?></td>
                    <td><?= $reporte->nombre_oficina ?? 'N/A'; ?></td>
                    <td><?= $grupo; ?></td>
                    <td>
                        <a href="<?= 'formulariopdf/'.$reporte->Idreporte?>" class="btn btn-success" type="button"><i class="ri-file-upload-fill"></i></a>
                    </td>
                </tr>
                <?php $contador++; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="8"><strong>Total:</strong> <?= $contador - 1; ?></td>
            </tr>
        </tbody>
    </table>
  </div>

  <script type="text/javascript">
    $(document).ready(function () {
        $("#menureporte").addClass("menu-open");
        $("#PDFs").addClass("active");

        // Agrega un evento al botón de búsqueda
        $("#searchButton").on("click", function () {
            // Obtiene el valor de búsqueda
            var searchText = $("#searchInput").val().toLowerCase();

            // Filtra las filas de la tabla según el valor de búsqueda
            var foundElements = $("#tablaReportes tbody tr").filter(function () {
                return $(this).text().toLowerCase().indexOf(searchText) > -1;
            });

            // Oculta todas las filas
            $("#tablaReportes tbody tr").hide();

            // Si se encontraron elementos, muestra solo esos
            if (foundElements.length > 0) {
                foundElements.show();
            } else {
                console.log("No se encontraron elementos.");
            }

            // Evita que el formulario se envíe (si este es un botón dentro de un formulario)
            return false;
        });
    });
  </script>

</section>
<!-- /.content -->

<?= $this->endSection(); ?>
