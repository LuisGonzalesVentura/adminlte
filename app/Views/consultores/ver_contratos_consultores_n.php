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
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Contratos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Archivo</th>
                                    <th>Tipo de Contrato</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Finalización</th>
                                    <!-- Add more columns if needed -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($contratosConsultores)): ?>
                                    <?php foreach ($contratosConsultores as $contrato): ?>
                                        <tr>
                                            <td>
                                                <a href="<?= base_url('pdfscontratos/' . $contrato['archivo_c_n']) ?>" target="_blank"><?= $contrato['archivo_c_n'] ?></a>

                                            </td>
                                            <td>
                                                <?= $contrato['tipo_contrato'] ?? 'Tipo de Contrato Desconocido'; ?>
                                            </td>
                                            <td><?= $contrato['fecha_inicio_contrato_c_n'] ?></td>
                                            <td><?= $contrato['fecha_finalizacion_contrato_c_n'] ?></td>
                                            <!-- Add more columns if needed -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">No hay contratos asociados a este reporte.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <?= anchor('Reporte/index', '<i class="ri-arrow-left-circle-fill"></i>', ['class' => 'btn btn-primary']); ?>
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
        var reportId = $(this).data("report-id");
        verDocumento(documentType, reportId);
    });
});
function verDocumento(documentType, reportId) {
    if (reportId !== null && reportId !== 'null') {
        // Realizar una solicitud AJAX para obtener el nombre del PDF
        $.ajax({
            url: "<?php echo base_url('Reporte/getDocumento') ?>",
            type: "POST",
            data: { type: documentType, id: reportId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Construir la URL con el nombre del PDF
                    var pdfUrl = "<?php echo base_url('PDFs') ?>/" + response.pdfName;

                    // Abrir el PDF en una nueva ventana
                    window.open(pdfUrl, '_blank');
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("Error al obtener el documento.");
            }
        });
    } else {
        alert("Report ID is not available.");
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
