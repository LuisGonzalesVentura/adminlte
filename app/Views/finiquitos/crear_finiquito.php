<?= $this->extend('Views/Dashboard/escritorio'); ?>
<!-- Agrega la hoja de estilo de Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Agrega jQuery (necesario para Select2) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Agrega la biblioteca Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<?= $this->section('contenido'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Subir finiquito</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Subir finiquito</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulario crear finiquito</h3>
                    </div>
                    <div class="card-body">
                    <form action="<?= base_url('finiquito/crear_finiquito') ?>" method='post' enctype="multipart/form-data" id="formulario_finiquito">
                            <div class="row">
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label for="id_empleado_c">Seleccionar RRHH para el finiquito</label>
                                        <select class="form-control" id="id_empleado_c" name="id_empleado_c" required>
                                            <option value="">Seleccionar empleado</option>
                                            <?php foreach ($empleados as $empleado): ?>
                                                <option value="<?= $empleado->Idreporte ?>"><?= $empleado->Ci ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="ruta_documentacion_pdf">Ruta documentación pdf</label>
                                        <input name="ruta_documentacion_pdf" type="file" class="form-control" id="ruta_documentacion_pdf" accept=".pdf">
                                    </div>
                                </div>

                                <div class="col-md-6">



                                    <div class="form-group">
                                        <label for="fecha_de_inicio">Fecha del finiquito</label>
                                        <input type="date" class="form-control" id="fecha_de_inicio" name="fecha_de_inicio" placeholder="Ingrese Fecha de inicio" required>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $("#menufiniquito").addClass("menu-open");
    $("#finiquito_subir").addClass("active");
</script>
<script type="text/javascript">
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
    <?php endif  ?>
</script>


<?= $this->endSection(); ?>
