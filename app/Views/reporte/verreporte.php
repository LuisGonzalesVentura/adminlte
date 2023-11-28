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
                                <?php if ($reporte): ?>
                                    <p><label>ID:  </label> <?= $reporte['Idreporte']; ?></p>
                                    <p><label>Apellido:  </label>  <?= $reporte['apellido']; ?></p>
                                    <p><label>Nombre:  </label>  <?= $reporte['nombre']; ?></p>
                                    <p><label>Carnet:  </label>  <?= $reporte['Ci']; ?></p>
                                    <p><label>Nua:  </label>  <?= $reporte['nua']; ?></p>
                                    <p><label>Fecha Nacimiento:  </label>  <?= $reporte['fechanacimiento']; ?></p>
                                    <p><label>Fecha Ingreso:  </label>  <?= $reporte['fechaingreso']; ?></p>
                                    <p><label>Fecha Retiro:  </label> <?= $reporte['fechafin']; ?></p>
                                    
                    <td>
                    <a href="<?= base_url('Reporte/documentos/' . $reporte['Idreporte']) ?>" class="btn btn-success" type="button">Documentos</a>
                                       <?= anchor('Reporte/index', 'Regresar', ['class' => 'btn btn-primary']); ?>
                    </td>   
                                <?php else: ?>
                                    
                                    <p>No se encontró el reporte seleccionado.</p>
                                <?php endif; ?>

                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    
                        <!-- Add footer content if needed -->
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
