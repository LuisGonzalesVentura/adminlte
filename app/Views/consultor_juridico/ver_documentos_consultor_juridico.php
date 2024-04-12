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
                <h2>Archivos de: <?= $consultor->RepresentanteLegal_Nombres_c_p . ' ' . $consultor->RepresentanteLegal_ApellidoPaterno_c_p . ' ' . $consultor->RepresentanteLegal_ApellidoMaterno_c_p; ?></h2>
            </tr>
            <tr>
            <td><label>Términos de referencia</label></td>
            <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="TerminoReferencia_TDR_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>Propuesta de la empresa</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="PropuestaEmpresa_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>Acta de selección de la empresa</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="ActaSeleccionEmpresa_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>NIT de la empresa</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="Nitdelaenmpresa_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>Poder del representante legal</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="PoderRepresentanteLegal_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>Currículum de la empresa</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="CurriculumEmpresa_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>Currículum de los profesionales</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="CurriculumProfesionales_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>Declaración jurada de antecedentes</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="DeclaracionJuradaAntecedentes_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>Boleta de garantía</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="BoletaGarantia_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr>
        <tr>
            <td><label>Contrato de servicio de consultoría</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="ContratoServicioConsultoria_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
            </td>
        </tr> <tr>
            <td><label>Formularios de pago a seguro a largo plazo</label></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="FormulariosPagoSeguroLargoPlazo_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Informe final del producto entregado</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="InformeFinalProductoEntregado_c_p" data-consultor-id="<?= $consultor->id_c_p	 ?>"><i class="ri-eye-fill"></i></a>
                </td>
            </tr>
            <tr>
                <td><label>Acta de conformidad del servicio</label></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="ActaConformidadServicio_c_p" data-consultor-id="<?= $consultor->id_c_p ?>"><i class="ri-eye-fill"></i></a>
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
                        <?= anchor('consultor_juridico/listarConsultoresJuridicos', '<i class="ri-arrow-left-circle-fill"></i>', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">


$("#menureporte").addClass("menu-open");
    $("#listaconulto_juridicor").addClass("active");


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
            url: "<?php echo base_url('consultor_juridico/getDocumento') ?>",
            type: "POST",
            data: { type: documentType, id: consultorId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Construir la URL con el nombre del PDF y abrirlo en una nueva ventana
                    window.open("<?php echo base_url('pdfsconsultores_j') ?>/" + response.pdfName, '_blank');
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
        alert("ID de consultor no válido.");
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
