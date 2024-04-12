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
                 <form action="<?= base_url('voluntarios/subir_pdf_voluntario/' . $id) ?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <?php if ($voluntario): ?>
            <h2>Subir archivos para <?= $voluntario->nombres_v . ' ' . $voluntario->apellido_paterno_v . ' ' . $voluntario->apellido_materno_v; ?></h2>
            <input type="hidden" name="id" value="<?= $voluntario->id_voluntario; ?>">
            <div class="form-group">
                <label for="convenio_interinstitucional_v">Convenio interinstitucional</label>
                <input name="convenio_interinstitucional_v" type="file" class="form-control" id="convenio_interinstitucional_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="carta_solicitud_voluntariado_v">Carta solicitud voluntariado</label>
                <input name="carta_solicitud_voluntariado_v" type="file" class="form-control" id="carta_solicitud_voluntariado_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="carnet_identidad_voluntariado_v">Carnet de identidad voluntariado</label>
                <input name="carnet_identidad_voluntariado_v" type="file" class="form-control" id="carnet_identidad_voluntariado_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="curriculum_vitae_v">Currículum vitae</label>
                <input name="curriculum_vitae_v" type="file" class="form-control" id="curriculum_vitae_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="declaracion_antecedentes_penales_v">Declaración de antecedentes penales</label>
                <input name="declaracion_antecedentes_penales_v" type="file" class="form-control" id="declaracion_antecedentes_penales_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="certificado_antecedentes_penales_v">Certificado de antecedentes penales</label>
                <input name="certificado_antecedentes_penales_v" type="file" class="form-control" id="certificado_antecedentes_penales_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="certificado_no_violencia_v">Certificado de no violencia</label>
                <input name="certificado_no_violencia_v" type="file" class="form-control" id="certificado_no_violencia_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="informe_examen_psicologico_v">Informe de examen psicológico</label>
                <input name="informe_examen_psicologico_v" type="file" class="form-control" id="informe_examen_psicologico_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="carnet_asegurado_seguro_corto_plazo_v">Carnet asegurado seguro corto plazo</label>
                <input name="carnet_asegurado_seguro_corto_plazo_v" type="file" class="form-control" id="carnet_asegurado_seguro_corto_plazo_v" accept=".pdf">
            </div>
           
            <div class="form-group">
                <label for="informe_final_producto_entregado_v">Informe final/producto entregado</label>
                <input name="informe_final_producto_entregado_v" type="file" class="form-control" id="informe_final_producto_entregado_v" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="certificado_voluntariado_v">Certificado de voluntariado</label>
                <input name="certificado_voluntariado_v" type="file" class="form-control" id="certificado_voluntariado_v" accept=".pdf">
            </div>
            <button type="submit" class="btn btn-primary">Subir PDF</button>
        <?php else: ?>
            <p>No se encontró el voluntario seleccionado.</p>
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
    $("#vista_formulario_crear_volun").addClass("active");

    // Agregar un listener al formulario para mostrar una confirmación antes de enviar
    $("form").submit(function (event) {
        event.preventDefault(); // Evitar que el formulario se envíe automáticamente

        var archivosSeleccionados = [];

        // Obtener todos los archivos seleccionados
        $('input[type="file"]').each(function () {
            var files = this.files;
            if (files.length > 0) {
                archivosSeleccionados.push(files[0].name);
            }
        });

        if (archivosSeleccionados.length > 0) {
            // Si hay al menos un archivo seleccionado, mostrar la ventana de confirmación
            var documentos = archivosSeleccionados.join('\n- ');

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Se subirán los siguientes documentos:\n- ' + documentos,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Subir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario
                    $("form")[0].submit();
                }
            });
        } else {
            // Si no hay archivos seleccionados, mostrar una advertencia
            Swal.fire({
                title: '¡Advertencia!',
                text: 'Selecciona al menos un documento para subir.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }
    });
</script>


<?=$this->endSection(); ?>
