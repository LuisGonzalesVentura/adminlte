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
    <table id="tablaReportes"  class="table table-light">
      
        <thead class="thead-light">
            <tr>

                <th>#</th>
                <th>Nombre de contrato</th>
                <th>Usuario creador</th>
                <th>Fecha creacion</th>
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
        <?= anchor('tipocontratos/listar_contratos', 'Lista', ['class' => 'btn btn-primary']); ?>
    </div>
   
                            </div>
                            
</div>
                            </div>
</div>

      </div>
      <?php foreach ($contratos as $contrato): ?>
            <tr>
                <td><?= $contrato->id_contrato; ?></td>
                <td><?= esc($contrato->tipo_contrato); ?></td>
                
                
                
                <td>
                    <?php if ($contrato->nombre && $contrato->apellido): ?>
                        <?= esc($contrato->nombre . ' ' . $contrato->apellido); ?>
                    <?php else: ?>
                        Sin usuario asignado
                    <?php endif; ?>
                </td>

                
                <td><?= esc($contrato->fecha_creacion); ?></td>
               <!-- <td><?= esc($contrato->fecha_modificacion); ?></td>-->
                
                    <!-- Agrega aquí tus botones de acciones -->

                    <td>
    <a href="<?php echo 'formulario_editar_contrato/' . $contrato->id_contrato ?>" class="btn btn-success" type="button">Editar Contrato</a>
</td>
 <!-- Agrega aquí tus botones de acciones -->
                
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
    $("#menucontratos").addClass("menu-open");
    $("#lista_ccontratos").addClass("active");
  </script>
  <?= $this->endSection(); ?>