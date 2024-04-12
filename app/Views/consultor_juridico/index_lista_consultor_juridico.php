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
          <li class="breadcrumb-item active">Reportes</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
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
        <?= anchor(current_url(), '<i class="ri-list-check"></i>', ['class' => 'btn btn-primary']); ?>
        </div>
    </div>

    <!-- Tabla de reportes -->
   <!-- Tabla de consultores -->
   <table id="tablaConsultores" class="table table-striped">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre de la empresa</th>

            <th>Apellido paterno R</th>
            <th>Apellido materno R</th>
            <th>Nombre(s) R</th>
            <th>Nº  Nit</th>
            <th>Oficina</th>
            <th>Inicio Servicio</th>
            <th>Conclusion Servicio</th>
            <th>Informacion</th>
            <th>Documentos</th>
            <th>Contratos</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $contador = 1;

        foreach ($consultores as $consultor) :
        ?>
        <tr>
            <td><?php echo $contador; ?></td>
            <td><?php echo $consultor->NombreEmpresa_c_p; ?></td>

            <td><?php echo $consultor->RepresentanteLegal_ApellidoPaterno_c_p; ?></td>
            <td><?php echo $consultor->RepresentanteLegal_ApellidoMaterno_c_p; ?></td>
            <td><?php echo $consultor->RepresentanteLegal_Nombres_c_p; ?></td>
            <td><?php echo $consultor->NITEmpresa_c_p; ?></td>
            <td><?php echo isset($consultor->nombre_oficina) ? $consultor->nombre_oficina : 'N/A'; ?></td>
            <td><?php echo $consultor->FechaInicioConsultoria_c_p; ?></td>
            <td><?php echo ($consultor->FechaConclusionConsultoria_c_p == '0000-00-00') ? 'N/A' : $consultor->FechaConclusionConsultoria_c_p; ?></td>
            <td>
                <a href="<?php echo 'informacion_consultores_juridicos/' . $consultor->id_c_p ?>" class="btn btn-success" type="button"><i class="ri-file-info-line"></i></a>
            </td>
            <td>
                <a href="<?php echo 'documentos_consultores_J/' . $consultor->id_c_p ?>" class="btn btn-success" type="button"><i class="ri-folder-unknow-fill"></i></i></a>
            </td>
            <td>
                <a href="<?php echo 'ver_contrato_consultores_j/' . $consultor->id_c_p ?>" class="btn btn-primary" type="button"><i class="ri-article-fill"></i></a>
            </td>
            <td>
                <a href="<?php echo 'formulario_editar_consultores_j/' . $consultor->id_c_p ?>" class="btn btn-success" type="button"><i class="ri-pencil-line"></i></a>
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
        $("#listaconulto_juridicor").addClass("active");

        // Agrega un evento al botón de búsqueda
        $("#searchButton").on("click", function () {
            // Obtiene el valor de búsqueda
            var searchText = $("#searchInput").val().toLowerCase();

            // Filtra las filas de la tabla según el valor de búsqueda
            var foundElements = $("#tablaConsultores tbody tr").filter(function () {
                return $(this).text().toLowerCase().indexOf(searchText) > -1;
            });

            // Oculta todas las filas
            $("#tablaConsultores tbody tr").hide();

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
  <script type="text/javascript">
   
    $(document).ready(function () {
        // Obtén todas las filas de la tabla
        var filas = $("#tablaReportes tbody tr");

        // Recorre cada fila y asigna un número secuencial en la columna #
        filas.each(function (index) {
            // Obtén la fila actual
            var fila = $(this);

            // Encuentra el elemento en la columna #
            var columnaNumero = fila.find('td:first');

            // Asigna el número secuencial
            columnaNumero.text(index  1);
        });
    });
</script>

<?= $this->endSection(); ?>