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
                 <form action="<?= base_url('consultor_juridico/subir_pdf_consultor_juridica/' . $id) ?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <?php if ($consultor): ?>
            <h2>Subir archivos para <?= $consultor->RepresentanteLegal_Nombres_c_p . ' ' . $consultor->RepresentanteLegal_ApellidoPaterno_c_p . ' ' . $consultor->RepresentanteLegal_ApellidoMaterno_c_p; ?></h2>
            <input type="hidden" name="id" value="<?= $consultor->id_c_p; ?>">
            <div class="form-group">
    <label for="terminos_referencia_n">Términos de referencia (TDR) para el servicio</label>
    <input name="TerminoReferencia_TDR_c_p" type="file" class="form-control" id="terminos_referencia_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="propuesta_profesional_n">Propuesta del profesional</label>
    <input name="PropuestaEmpresa_c_p" type="file" class="form-control" id="propuesta_profesional_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="acta_seleccion_proveedor_n">Acta selección del proveedor del servicio</label>
    <input name="ActaSeleccionEmpresa_c_p" type="file" class="form-control" id="acta_seleccion_proveedor_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="nitdelaenmpresa_n">NIT de la empresa</label>
    <input name="Nitdelaenmpresa_c_p" type="file" class="form-control" id="nitdelaenmpresa_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="poder_representante_legal_n">Poder del representante legal</label>
    <input name="PoderRepresentanteLegal_c_p" type="file" class="form-control" id="poder_representante_legal_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="curriculum_empresa_n">Currículum de la empresa</label>
    <input name="CurriculumEmpresa_c_p" type="file" class="form-control" id="curriculum_empresa_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="curriculum_profesionales_n">Currículum de los profesionales</label>
    <input name="CurriculumProfesionales_c_p" type="file" class="form-control" id="curriculum_profesionales_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="declaracion_jurada_antecedentes_n">Declaración jurada de antecedentes</label>
    <input name="DeclaracionJuradaAntecedentes_c_p" type="file" class="form-control" id="declaracion_jurada_antecedentes_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="boleta_garantia_n">Boleta de garantía</label>
    <input name="BoletaGarantia_c_p" type="file" class="form-control" id="boleta_garantia_n" accept=".pdf">
</div>

<div class="form-group">
    <label for="formularios_pago_seguro_largo_plazo_n">Formularios de pago aportes al seguro largo plazo</label>
    <input name="FormulariosPagoSeguroLargoPlazo_c_p" type="file" class="form-control" id="formularios_pago_seguro_largo_plazo_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="informe_final_producto_entregado_n">Informe final/producto(s) entregado(s)</label>
    <input name="InformeFinalProductoEntregado_c_p" type="file" class="form-control" id="informe_final_producto_entregado_n" accept=".pdf">
</div>
<div class="form-group">
    <label for="acta_conformidad_servicio_n">Acta de conformidad del servicio</label>
    <input name="ActaConformidadServicio_c_p" type="file" class="form-control" id="acta_conformidad_servicio_n" accept=".pdf">
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
    $("#vista_formulario_crear_consultores_naturalsd").addClass("active");

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
