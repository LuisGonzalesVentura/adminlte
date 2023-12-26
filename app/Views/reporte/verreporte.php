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
                    <table class="table">
    <thead>
        <tr>
            <th>Campo</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($reporte): ?>
            <tr>
            <th><strong>ID</strong></th>
                <td><?= $reporte['Idreporte']; ?></td>
            </tr>
            <tr>
            <th><strong>Apellido</strong></th>
                <td><?= $reporte['apellido']; ?></td>
            </tr>
            <tr>
            <th><strong>Nombre</strong></th>
                <td><?= $reporte['nombre']; ?></td>
            </tr>
            <tr>
            <th><strong>Carnet</strong></th>
                <td><?= $reporte['Ci']; ?></td>
            </tr>
            <tr>
            <th><strong>Nua</strong></th>
                <td><?= $reporte['nua']; ?></td>
            </tr>
            <tr>
            <th><strong>Fecha Nacimiento</strong></th>
                <td><?= $reporte['fechanacimiento']; ?></td>
            </tr>
            <tr>
            <th><strong>Fecha Ingreso</strong></th>
                <td><?= $reporte['fechaingreso']; ?></td>
            </tr>
            <tr>
            <th><strong>Fecha Fin</strong></th>
                <td><?= $reporte['fechafin']; ?></td>
            </tr>
            <th><strong>Ubicacion del archivo</strong></th>
                <td><?= $reporte['ubicacion']; ?></td>
            </tr>
            
            
            <tr>
                
                <td>
                    <a href="<?= base_url('Reporte/documentos/' . $reporte['Idreporte']) ?>" class="btn btn-success" type="button">Ver Documentos</a>
                    <?= anchor('Reporte/index', 'Regresar', ['class' => 'btn btn-primary']); ?>
                
                </td>
            </tr>
           
        <?php else: ?>
            <tr>
                <td colspan="2">No se encontró el reporte seleccionado.</td>
            </tr>
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
