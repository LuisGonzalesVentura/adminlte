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
                <h1>Subir Contratos juridicos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Subir Contratos juridicos</li>
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
                    <form action="<?= base_url('contrato_consultor_jj/crearContratoConsultoria') ?>" method='post' enctype="multipart/form-data" id="formulario_contrato">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_consultor">Seleccionar consultor para el contrato</label>
                <select class="form-control" id="id_consultor" name="id_consultor">
                    <option value="">Seleccionar consultor</option>
                    <?php foreach ($empleados_consultoria as $consultor): ?>
                        <option value="<?= $consultor->id_c_p ?>"><?= $consultor->NITEmpresa_c_p ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="archivo_c_j">Ruta documentación pdf</label>
                <input name="archivo_c_j" type="file" class="form-control" id="archivo_c_j" accept=".pdf">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tipo_contrato_c_j">Seleccionar el tipo de contrato</label>
                <select class="form-control" id="tipo_contrato_c_j" name="tipo_contrato_c_j" required>
                    <option value="">Seleccionar tipo de contrato</option>
                    <?php foreach ($tipos_contrato as $tipo_contrato): ?>
                        <option value="<?= $tipo_contrato->id_contrato ?>"><?= $tipo_contrato->tipo_contrato ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_inicio_contrato_c_j">Fecha inicio contrato</label>
                <input type="date" class="form-control" id="fecha_inicio_contrato_c_j" name="fecha_inicio_contrato_c_j" placeholder="Ingrese Fecha de inicio" required>
            </div>
            <div class="form-group">
                <label for="fecha_finalizacion_contrato_c_j">Fecha Finalización contrato</label>
                <input type="date" class="form-control" id="fecha_finalizacion_contrato_c_j" name="fecha_finalizacion_contrato_c_j" placeholder="Ingrese Fecha de finalización">
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
    $("#crear_contratos_consultoria_j").addClass("active");
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
