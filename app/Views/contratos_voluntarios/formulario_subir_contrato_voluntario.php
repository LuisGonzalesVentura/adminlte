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
                <h1>Subir Contratos de Voluntarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Subir Contratos de Voluntarios</li>
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
                        <h3 class="card-title">Formulario de subir contratos</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('contratos_voluntarios/crearContratoVoluntario') ?>" method='post' enctype="multipart/form-data" id="formulario_contrato">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Voluntario_id">Seleccionar voluntario para el contrato</label>
                                        <select class="form-control" id="Voluntario_id" name="Voluntario_id">
                                            <option value="">Seleccionar voluntario</option>
                                            <?php foreach ($voluntarios as $voluntario): ?>
                                                <option value="<?= $voluntario->id_voluntario ?>"><?= $voluntario->carnet_identidad_v ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="archivo_v">Ruta documentación pdf</label>
                                        <input name="archivo_v" type="file" class="form-control" id="archivo_v" accept=".pdf">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_contrato_voluntario">Seleccionar el tipo de contrato</label>
                                        <select class="form-control" id="tipo_contrato_voluntario" name="tipo_contrato_voluntario" required>
                                            <option value="">Seleccionar tipo de contrato</option>
                                            <?php foreach ($tipos_contrato as $tipo_contrato): ?>
                                                <option value="<?= $tipo_contrato->id_contrato ?>"><?= $tipo_contrato->tipo_contrato ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_inicio_contrato_voluntario">Fecha inicio contrato</label>
                                        <input type="date" class="form-control" id="fecha_inicio_contrato_voluntario" name="fecha_inicio_contrato_voluntario" placeholder="Ingrese Fecha de inicio" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_finalizacion_contrato_voluntario">Fecha Finalización contrato</label>
                                        <input type="date" class="form-control" id="fecha_finalizacion_contrato_voluntario" name="fecha_finalizacion_contrato_voluntario" placeholder="Ingrese Fecha de finalización">
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
    $("#menucontratospdff").addClass("menu-open");
    $("#lista_ccontratosss_voluntario").addClass("active");
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