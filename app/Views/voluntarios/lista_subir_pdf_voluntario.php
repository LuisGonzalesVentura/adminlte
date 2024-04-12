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
                <th>Nº Carnet</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Nombre(s)</th>
                <th>Oficina</th>
                <th>Inicio Servicio</th>
                <th>Conclusion Servicio</th>
                <th>Tipo de voluntariado</th>
                <th>Subir PDFS</th>
               
                
            </tr>
        </thead>
        <tbody>
            <?php
            $contador = 1;
            foreach ($voluntarios as $voluntario) :
            ?>
            <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $voluntario->carnet_identidad_v; ?></td>
                <td><?php echo $voluntario->apellido_paterno_v; ?></td>
                <td><?php echo $voluntario->apellido_materno_v; ?></td>
                <td><?php echo $voluntario->nombres_v; ?></td>
                <td><?php echo isset($voluntario->nombre_oficina) ? $voluntario->nombre_oficina : 'N/A'; ?></td>
                <td><?php echo $voluntario->fecha_inicio_servicio_v; ?></td>
                <td><?php echo $voluntario->fecha_conclusion_servicio_v; ?></td>
                <td><?php echo $voluntario->tipo_voluntariado_v; ?></td>
             
                <td>
                    <a href="<?php echo 'formulario_pdf_voluntarios/' . $voluntario->id_voluntario ?>" class="btn btn-success" type="button"><i class="ri-file-upload-fill"></i></i></a>
                </td>
               
            </tr>
            <?php $contador++; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="13"><strong>Total:</strong> <?= $contador - 1; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#menureporte").addClass("menu-open");
        $("#vista_formulario_crear_volun").addClass("active");

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