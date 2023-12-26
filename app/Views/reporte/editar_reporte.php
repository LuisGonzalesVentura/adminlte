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
                    <li class="breadcrumb-item active">Editar Reporte</li>
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
                        <h3 class="card-title">Editar Reporte</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url('Reporte/guardar_edicion') ?>" method='post' enctype="multipart/form-data" id="editarForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre" value="<?= $reporte['nombre'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa apellidos" value="<?= $reporte['apellido'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="Ci">Carnet</label>
                                <input type="text" class="form-control" id="Ci" name="Ci" placeholder="Ingresa Carnet" value="<?= $reporte['Ci'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="nua">Nua</label>
                                <input type="text" class="form-control" id="nua" name="nua" placeholder="Ingresa Nua" value="<?= $reporte['nua'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fechanacimiento">Fecha nacimiento</label>
                                <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" placeholder="Fecha nacimiento" value="<?= $reporte['fechanacimiento'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaingreso">Fecha Ingreso</label>
                                <input type="date" class="form-control" id="fechaingreso" name="fechaingreso" placeholder="Fecha ingreso" value="<?= $reporte['fechaingreso'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fechafin">Fecha Retiro</label>
                                <input type="date" class="form-control" id="fechafin" name="fechafin" placeholder="Fecha retiro" value="<?= $reporte['fechafin'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="ubicacion">Ubicacion del archivo</label>
                                <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresa ubicacion" value="<?= $reporte['ubicacion'] ?>" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
        <input type="hidden" name="id_reporte" value="<?= $reporte['Idreporte'] ?>">
        <button type="submit" class="btn btn-primary" id="btnGuardarEdicion" onclick="mostrarAlerta()">Guardar Edición</button>
    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $("#menureporte").addClass("menu-open");
    $("#editar_reporte").addClass("active");

    function mostrarAlerta() {
        Swal.fire({
            title: 'Éxito',
            icon: 'success',
            timer: 5000, // 5000 milisegundos = 5 segundos
            showConfirmButton: false
        });
    }
</script>




    <?= $this->endSection(); ?>