<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1><?= $titulo; ?></h1>

                <!-- Add content header content if needed -->
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detalles del Reporte</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table>
                            <thead>
                                <!-- Add table header content if needed -->
                            </thead>
                            <tbody>
    <?php if ($report): ?>
    
    <p><label>ID:  </label> <?= $report['Idreporte']; ?></p>
    <p><label>Apellido:  </label>  <?= $report['apellido']; ?></p>
    <p><label>Nombre:  </label>  <?= $report['nombre']; ?></p>
    <p><label>Carnet:  </label>  <?= $report['Ci']; ?></p>
    <p><label>Nua:  </label>  <?= $report['nua']; ?></p>
    <p><label>Fecha Nacimiento:  </label>  <?= $report['fechanacimiento']; ?></p>
    <p><label>Fecha Ingreso:  </label>  <?= $report['fechaingreso']; ?></p>
    <p><label>Fecha Retiro:  </label> <?= $report['fechafin']; ?></p>

    

    <!-- Agrega más detalles según sea necesario -->
   <?php else: ?>
    <p>No se encontró el reporte seleccionado.</p>
   <?php endif; ?>
   
    </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <?= anchor('Reporte/documentos/' . $report['Idreporte'], 'Documentos', ['class' => 'btn btn-primary']); ?>
                        <?= anchor('Reporte/index', 'Regresar', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("#menureporte").addClass("menu-open");
    $("#reportelista").addClass("active");
</script>

<?= $this->endSection(); ?>
