<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- Add content header content if needed -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Reportes</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- ... (your existing code) ... -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detalles del Reporte</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table">
    <thead>
        <!-- Add table header content if needed -->
    </thead>
    <tbody>
        <?php if ($voluntario): ?>
            <tr>
            <h2>Subir archivos para <?= $voluntario->nombres_v . ' ' . $voluntario->apellido_paterno_v . ' ' . $voluntario->apellido_materno_v; ?></h2>
            </tr>
            <tr>
                <td><label>Convenio Interinstitucional</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="convenio_interinstitucional_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Carta de Solicitud de Voluntariado</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="carta_solicitud_voluntariado_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Carnet de Identidad del Voluntario</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="carnet_identidad_voluntariado_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Curriculum Vitae</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="curriculum_vitae_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Declaración de Antecedentes Penales</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="declaracion_antecedentes_penales_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Certificado de Antecedentes Penales</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="certificado_antecedentes_penales_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Certificado de No Violencia</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="certificado_no_violencia_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Informe de Examen Psicológico</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="informe_examen_psicologico_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Carnet Asegurado Seguro Corto Plazo</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="carnet_asegurado_seguro_corto_plazo_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Informe Final del Producto Entregado</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="informe_final_producto_entregado_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Certificado de Voluntariado</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="certificado_voluntariado_v" data-voluntario-id="<?= $voluntario->id_voluntario ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <!-- Agrega más filas para los demás documentos -->
        <?php else: ?>
            <tr>
                <td colspan="2">No se encontraron documentos para este voluntario.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


                        
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <?= anchor('voluntarios/listarVoluntarios', '<i class="ri-arrow-left-circle-fill"></i>', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">

$(document).ready(function () {
    $("#menureporte").addClass("menu-open");
        $("#listaconulto_voluntario").addClass("active");
    $(".verDocumentoBtn").on("click", function () {
        var documentType = $(this).data("document-type");
        var voluntarioId = $(this).data("voluntario-id"); // Cambio realizado aquí
        verDocumentoVoluntario(documentType, voluntarioId); // Cambio realizado aquí
    });
});

function verDocumentoVoluntario(documentType, id_voluntario) {
    if (id_voluntario !== null && id_voluntario !== 'null') {
        // Realizar una solicitud AJAX para obtener el nombre del PDF
        $.ajax({
            url: "<?php echo base_url('voluntarios/getDocumentoVoluntario') ?>",
            type: "POST",
            data: { type: documentType, id: id_voluntario },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Construir la URL con el nombre del PDF y abrirlo en una nueva ventana
                    window.open("<?php echo base_url('pdfs_voluntarios') ?>/" + response.pdfName, '_blank');
                } else {
                    alert(response.message); // Mostrar mensaje de error
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Registrar detalles del error en la consola
                alert("Error al obtener el documento. Consulta la consola para más detalles.");
            }
        });
    } else {
        alert("ID de voluntario no válido.");
    }
}











function b64toBlob(b64Data, contentType = '', sliceSize = 512) {
    const byteCharacters = atob(b64Data);
    const byteArrays = [];

    for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        const slice = byteCharacters.slice(offset, offset + sliceSize);

        const byteNumbers = new Array(slice.length);
        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        const byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }

    const blob = new Blob(byteArrays, { type: contentType });
    return blob;
}
</script>

<style>
    /* Additional CSS styles for better visual appearance */
    .card-title {
        font-size: 1.5rem; /* Adjust font size as needed */
    }

    .table {
        margin-bottom: 0; /* Remove the default bottom margin for the table */
    }

    .table td,
    .table th {
        padding: 1px; /* Adjust cell padding as needed */
        font-size: 15px; /* Adjust font size as needed */
    }

    .table-condensed>thead>tr>th,
    .table-condensed>tbody>tr>th,
    .table-condensed>tfoot>tr>th,
    .table-condensed>thead>tr>td,
    .table-condensed>tbody>tr>td,
    .table-condensed>tfoot>tr>td {
        padding: 5px; /* Adjust padding for condensed table */
    }
</style>




<?= $this->endSection(); ?>
