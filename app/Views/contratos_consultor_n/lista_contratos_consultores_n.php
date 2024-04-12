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
        <table id="tablaReportes" class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Carnet</th>
            <th>Nombre del Consultor</th>
            <th>Archivo</th>
            <th>Tipo de contrato</th>
            <th>Fecha de inicio del contrato</th>
            <th>Fecha de finalización del contrato</th>
            <th>Acciones</th>
        </tr>
    </thead>


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
    <?= anchor(current_url(), '<i class="ri-list-check"></i>', ['class' => 'btn btn-primary']); ?>
    </div>
   
                            </div>
                            
</div>
    <tbody>
        <!-- Iterar sobre los contratos de consultoría -->
        <?php foreach ($contratos_consultores as $contrato_consultor) : ?>
            <tr>
                <td><?= $contrato_consultor['ci_consultor'] ?></td> <!-- Mostrar el CI del consultor -->
                <td><?= $contrato_consultor['nombre_consultor'] ?></td> <!-- Mostrar el nombre completo del consultor -->
                <td>
                    <a href="<?= base_url('pdfscontratos/' . $contrato_consultor['archivo_c_n']) ?>" target="_blank">
                        Abrir Archivo
                    </a>
                    
                </td>
                <td>
    <?php
    // Obtener el nombre del tipo de contrato utilizando el modelo TipoContrato
    $tipoContratoModel = new \App\Models\TipoContrato();
    $tipoContrato = $tipoContratoModel->find($contrato_consultor['tipo_contrato_c_n']);

    // Verificar si se encontró el tipo de contrato
    if ($tipoContrato) {
        echo $tipoContrato->tipo_contrato; // Mostrar el nombre del tipo de contrato
    } else {
        echo 'Desconocido'; // Si no se encuentra, mostrar 'Desconocido'
    }
    ?>
</td>
                <td><?= $contrato_consultor['fecha_inicio_contrato_c_n'] ?></td> <!-- Mostrar la fecha de inicio del contrato -->
                <td><?= $contrato_consultor['fecha_finalizacion_contrato_c_n'] ?></td> <!-- Mostrar la fecha de finalización del contrato -->
                <td>
                    <!-- Enlace para editar el contrato consultor -->
                    <a href="<?= base_url('contrato_consultor_nn/vista_formulario_edicion_contrato/' . $contrato_consultor['idcontrato_c_n']) ?>" class="btn btn-success" type="button">Editar contrato</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
<script type="text/javascript">
    $(document).ready(function () {
       
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



      </div>
    </div>
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
  <script type="text/javascript">
    $("#menucontratospdff").addClass("menu-open");
    $("#lista_ccontratosss_consultor").addClass("active");
  </script>
  <?= $this->endSection(); ?>