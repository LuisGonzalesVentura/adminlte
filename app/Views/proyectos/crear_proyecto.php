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
                    <li class="breadcrumb-item active">Crear Proyecto</li>
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
                        <h3 class="card-title">Reporte Proyecto</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url('Proyectos/guardar_proyecto') ?>" method='post' enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- Oficina -->
                            <div class="form-group">
    <label for="oficinaproyecto">Oficina</label>
    <select class="form-control" id="oficinaproyecto" name="oficinaproyecto" required>
        <option value="Fondo Patrimonial">Fondo Patrimonial</option>
        <option value="Nacional">Nacional</option>
        <option value="Filial Cochabamba">Filial Cochabamba</option>
        <option value="Filial La Paz - El Alto">Filial La Paz - El Alto</option>
        <option value="Filial Oruro">Filial Oruro</option>
        <option value="Filial Santa Cruz">Filial Santa Cruz</option>
    </select>
</div>
                           <!-- Financiador -->
<div class="form-group">
    <label for="financiador">Financiador</label>
    <input type="text" class="form-control" id="financiador" name="financiador" placeholder="Ingresar financiador" required>
</div>

<!-- Codigo del proyecto -->
<div class="form-group">
    <label for="codigo_del_proyecto">Codigo del proyecto</label>
    <input type="text" class="form-control" id="codigo_del_proyecto" name="codigo_del_proyecto" placeholder="Ingresar código del proyecto" required>
</div>

                            <!-- Nombre del proyecto -->
                            <div class="form-group">
                                <label for="nombre_proyecto">Nombre del proyecto</label>
                                <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" placeholder="Ingresar nombre del Proyecto" required>
                            </div>
                            <!-- Descripcion del proyecto -->
                            <div class="form-group">
                                <label for="descripcion_del_proyecto">Descripcion proyecto</label>
                                <input type="text" class="form-control" id="descripcion_del_proyecto" name="descripcion_del_proyecto" placeholder="Ingresa Descripcion del proyecto" required>
                            </div>
                            <!-- Fecha inicio -->
                            <div class="form-group">
                                <label for="fecha_de_inicio">Fecha inicio</label>
                                <input type="date" class="form-control" id="fecha_de_inicio" name="fecha_de_inicio" placeholder="Ingrese Fecha de inicio" required>
                            </div>
                            <!-- Fecha conclusion -->
                            <div class="form-group">
                                <label for="fecha_fin">Fecha conclusion</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="Ingrese Fecha Fin" required>
                            </div>
                            <!-- Ruta documentacion pdf -->
                            <div class="form-group">
                                <label for="ruta_documentacion_pdf">Ruta documentacion pdf</label>
                                <input name="ruta_documentacion_pdf" type="file" class="form-control" id="ruta_documentacion_pdf" accept=".pdf">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Crear Proyecto</button>
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
    $("#menuproyecto").addClass("menu-open");
    $("#crearproyecto").addClass("active");

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
