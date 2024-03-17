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
                 <form action="<?= base_url('consultores/subir_pdf_consultor_natural/' . $id) ?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <?php if ($consultor): ?>
            <h2>Subir archivos para <?= $consultor->nombres_n . ' ' . $consultor->apellido_paterno_n . ' ' . $consultor->apellido_materno_n; ?></h2>
            <input type="hidden" name="id" value="<?= $consultor->consultoria_id_n; ?>">

            <div class="form-group">
                <label for="terminos_referencia_n">Términos de referencia (TDR) para el servicio</label>
                <input name="terminos_referencia_n" type="file" class="form-control" id="terminos_referencia_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="propuesta_profesional_n">Propuesta del profesional</label>
                <input name="propuesta_profesional_n" type="file" class="form-control" id="propuesta_profesional_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="acta_seleccion_proveedor_n">Acta selección del proveedor del servicio</label>
                <input name="acta_seleccion_proveedor_n" type="file" class="form-control" id="acta_seleccion_proveedor_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="certificado_antecedentes_penales_n">Certificado de antecedentes penales</label>
                <input name="certificado_antecedentes_penales_n" type="file" class="form-control" id="certificado_antecedentes_penales_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="certificado_no_violencia_n">Certificado de No violencia</label>
                <input name="certificado_no_violencia_n" type="file" class="form-control" id="certificado_no_violencia_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="carnet_asegurado_n">Carnet de asegurado seguro corto plazo</label>
                <input name="carnet_asegurado_n" type="file" class="form-control" id="carnet_asegurado_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="curriculum_vitae_profesional_n">Currículum vite del profesional</label>
                <input name="curriculum_vitae_profesional_n" type="file" class="form-control" id="curriculum_vitae_profesional_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="carnet_identidad_profesional_n">Carnet de identidad del profesional</label>
                <input name="carnet_identidad_profesional_n" type="file" class="form-control" id="carnet_identidad_profesional_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="nit_profesional_n">NIT del profesional</label>
                <input name="nit_profesional_n" type="file" class="form-control" id="nit_profesional_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="boleta_garantia_n">Boleta de garantía (si corresponde)</label>
                <input name="boleta_garantia_n" type="file" class="form-control" id="boleta_garantia_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="formularios_pago_seguro_largo_plazo_n">Formularios pago aportes al seguro largo plazo</label>
                <input name="formularios_pago_seguro_largo_plazo_n" type="file" class="form-control" id="formularios_pago_seguro_largo_plazo_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="informe_final_producto_entregado_n">Informe final/producto(s) entregado(s)</label>
                <input name="informe_final_producto_entregado_n" type="file" class="form-control" id="informe_final_producto_entregado_n" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="acta_conformidad_servicio_n">Acta de conformidad del servicio</label>
                <input name="acta_conformidad_servicio_n" type="file" class="form-control" id="acta_conformidad_servicio_n" accept=".pdf">
            </div>

            <button type="submit" class="btn btn-primary">Subir PDF</button>
        <?php else: ?>
            <p>No se encontró el consultor seleccionado.</p>
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
    $("#vista_formulario_crear_consultores_naturals").addClass("active");

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
