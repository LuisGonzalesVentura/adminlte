<?=$this->extend('Views/Dashboard/escritorio'); ?>

<?=$this->section('contenido'); ?>

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
                    <li class="breadcrumb-item active">Subir PDF</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Subir PDF</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url('Reporte/subirPDF/' . $id) ?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <?php if ($report): ?>
            <h2>Subir carnet escaneado para <?= $report['nombre'] . ' ' . $report['apellido']; ?></h2>
            <input type="hidden" name="id" value="<?= $report['Idreporte']; ?>">
            <div class="form-group">
                <label for="pdfUsuario">Seleccionar archivo PDF</label>
                <input name="pdfUsuario" type="file" class="form-control" id="pdfUsuario" accept=".pdf">
            </div>
            <button type="submit" class="btn btn-primary">Subir PDF</button>
        <?php else: ?>
            <p>No se encontró el reporte seleccionado.</p>
        <?php endif; ?>
    </div>
</form>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<!-- /.content -->

<script type="text/javascript">
    $("#menuAdministracion").addClass("menu-open");
    $("#menuUsuarios").addClass("active");
</script>

<?=$this->endSection(); ?>
