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
                 <!-- ... -->

<!-- ... -->

<form action="<?= base_url('Reporte/subirPDF/' . $id) ?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <?php if ($report): ?>
            <h2>Subir archivos para <?= $report['nombre'] . ' ' . $report['apellido']; ?></h2>
            <input type="hidden" name="id" value="<?= $report['Idreporte']; ?>">
            
            <div class="form-group">
                <label for="pdfCarnet">Seleccionar archivo PDF Carnet Escaneado</label>
                <input name="pdfCarnet" type="file" class="form-control" id="pdfCarnet" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="pdfIngresoCaja">Seleccionar archivo PDF Ingreso Caja</label>
                <input name="pdfIngresoCaja" type="file" class="form-control" id="pdfIngresoCaja" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="pdfContrato1">Seleccionar archivo PDF Contrato1</label>
                <input name="pdfContrato1" type="file" class="form-control" id="pdfContrato1" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="pdfFiniquito1">Seleccionar archivo PDF Finiquito1</label>
                <input name="pdfFiniquito1" type="file" class="form-control" id="pdfFiniquito1" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="pdfRetiroCaja">Seleccionar archivo PDF Retiro Caja</label>
                <input name="pdfRetiroCaja" type="file" class="form-control" id="pdfRetiroCaja" accept=".pdf">
            </div>

            <button type="submit" class="btn btn-primary">Subir PDFs</button>
        <?php else: ?>
            <p>No se encontró el reporte seleccionado.</p>
        <?php endif; ?>
    </div>
</form>

<!-- ... -->


<!-- ... -->


                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<!-- /.content -->

<script type="text/javascript">
   $("#menureporte").addClass("menu-open");
    $("#PDFs").addClass("active");
</script>

<?=$this->endSection(); ?>
