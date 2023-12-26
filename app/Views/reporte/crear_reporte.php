<?= $this->extend('Views/Dashboard/escritorio'); ?>


<?= $this->section('contenido'); ?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $titulo; ?></h1>
                <?php

?>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Crear Reporte</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Reporte Nuevo</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url('Reporte/guardar_reporte') ?>" method='post' enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa apellidos" required>
                            </div>
                            <div class="form-group">
                                <label for="Ci">Carnet</label>
                                <input type="text" class="form-control" id="Ci" name="Ci" placeholder="Ingresa Carnet">
                            </div>
                            <div class="form-group">
                                <label for="nua">Nua</label>
                                <input type="text" class="form-control" id="nua" name="nua" placeholder="Ingresa Nua" required>
                            </div>
<div class="form-group">
    <label for="fechanacimiento">Fecha nacimiento</label>
    <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" placeholder="Fecha nacimiento" required>
</div>
<div class="form-group">
    <label for="fechaingreso">Fecha Ingreso</label>
    <input type="date" class="form-control" id="fechaingreso" name="fechaingreso" placeholder="Fecha ingreso" required>
</div>
<div class="form-group">
    <label for="fechafin">Fecha Retiro</label>
    <input type="date" class="form-control" id="fechafin" name="fechafin" placeholder="Fecha retiro">
</div>

<div class="form-group">
                                <label for="ubicacion">Ubicacion</label>
                                <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresa la ubicacion" required>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Crear</button>
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
    $("#menureporte").addClass("menu-open");
    $("#crearreporte").addClass("active");

    // Muestra mensajes de éxito o error con SweetAlert2
    <?php if (session()->has('success_message')): ?>
        Swal.fire({
            title: 'Éxito',
            text: '<?= session('success_message') ?>',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    <?php elseif (session()->has('error_message')): ?>
        Swal.fire({
            title: 'Error',
            text: '<?= session('error_message') ?>',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
</script>

    <?= $this->endSection(); ?>