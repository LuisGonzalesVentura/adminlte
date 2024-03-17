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
            <h2>Subir archivos para <?= $report->nombre . ' ' . $report->apellido; ?></h2>
<input type="hidden" name="id" value="<?= $report->Idreporte; ?>">


            <div class="form-group">
                <label for="acta_de_seleccion">Acta de selección</label>
                <input name="acta_de_seleccion" type="file" class="form-control" id="acta_de_seleccion" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="informe_examen_psicologico">Informe exámen psicológico (si corresponde)</label>
                <input name="informe_examen_psicologico" type="file" class="form-control" id="informe_examen_psicologico" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="pdfCarnet">Carnet de identidad</label>
                <input name="pdfCarnet" type="file" class="form-control" id="pdfCarnet" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="certificado_de_antecedentes_penales">Certificado de antecedentes penales</label>
                <input name="certificado_de_antecedentes_penales" type="file" class="form-control" id="certificado_de_antecedentes_penales" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="certificado_de_no_violencia">Certificado de No violencia</label>
                <input name="certificado_de_no_violencia" type="file" class="form-control" id="certificado_de_no_violencia" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="curriculum_vitae">Currículum vite</label>
                <input name="curriculum_vitae" type="file" class="form-control" id="curriculum_vitae" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="memorandum_asignacion_del_cargo">Memorandum asignación del cargo</label>
                <input name="memorandum_asignacion_del_cargo" type="file" class="form-control" id="memorandum_asignacion_del_cargo" accept=".pdf">
            </div>
           
            <div class="form-group">
                <label for="pdfIngresoCaja">Formulario parte ingreso CPS</label>
                <input name="pdfIngresoCaja" type="file" class="form-control" id="pdfIngresoCaja" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="carnet_de_asegurado_cps">Carnet asegurdo CPS</label>
                <input name="carnet_de_asegurado_cps" type="file" class="form-control" id="carnet_de_asegurado_cps" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="formulario_aporte_seguro_a_largo_plazo">Formulario aporte seguro a largo plazo</label>
                <input name="formulario_aporte_seguro_a_largo_plazo" type="file" class="form-control" id="formulario_aporte_seguro_a_largo_plazo" accept=".pdf">
            </div>
            
            
          
            <div class="form-group">
                <label for="formulario_de_desvinculacion">Formulario desvinculación</label>
                <input name="formulario_de_desvinculacion" type="file" class="form-control" id="formulario_de_desvinculacion" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="certificado_trabajo">Certificado de trabajo</label>
                <input name="certificado_trabajo" type="file" class="form-control" id="certificado_trabajo" accept=".pdf">
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
