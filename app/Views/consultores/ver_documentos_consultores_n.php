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
        <?php if ($consultor): ?>
            <tr>
                <h2>Archivos de: <?= $consultor->nombres_n . ' ' . $consultor->apellido_paterno_n . ' ' . $consultor->apellido_materno_n; ?></h2>
            </tr>
            <tr>
                <td><label>Términos de referencia</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="terminos_referencia_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Propuesta profesional</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="propuesta_profesional_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Acta de selección del proveedor</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="acta_seleccion_proveedor_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Certificado de antecedentes penales</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="certificado_antecedentes_penales_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Certificado de no violencia</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="certificado_no_violencia_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Carnet asegurado</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="carnet_asegurado_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Currículum vitae profesional</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="curriculum_vitae_profesional_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Carnet de identidad profesional</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="carnet_identidad_profesional_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>NIT profesional</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="nit_profesional_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Boleta de garantía</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="boleta_garantia_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Formularios de pago seguro a largo plazo</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="formularios_pago_seguro_largo_plazo_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Informe final producto entregado</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="informe_final_producto_entregado_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Acta de conformidad del servicio</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="acta_conformidad_servicio_n" data-consultor-id="<?= $consultor->consultoria_id_n ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <!-- Agrega más filas para los demás documentos -->
        <?php else: ?>
            <tr>
                <td colspan="2">No se encontraron documentos para este consultor.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

                        
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <?= anchor('consultores/listarConsultores_n', '<i class="ri-arrow-left-circle-fill"></i>', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">


$("#menureporte").addClass("menu-open");
    $("#listaconultor").addClass("active");


    $(document).ready(function () {
    $(".verDocumentoBtn").on("click", function () {
        var documentType = $(this).data("document-type");
        

        var consultorId = $(this).data("consultor-id");
verDocumento(documentType, consultorId);

    });
});
function verDocumento(documentType, consultorId) {
    if (consultorId !== null && consultorId !== 'null') {
        // Realizar una solicitud AJAX para obtener el nombre del PDF
        $.ajax({
            url: "<?php echo base_url('Consultores/getDocumento') ?>",
            type: "POST",
            data: { type: documentType, id: consultorId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Construir la URL con el nombre del PDF y abrirlo en una nueva ventana
                    window.open("<?php echo base_url('pdfsconsultores_n') ?>/" + response.pdfName, '_blank');
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
        alert("Consultor ID is not available.");
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
