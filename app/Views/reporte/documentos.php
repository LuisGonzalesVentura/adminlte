<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>



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
                            <!-- En la vista documentos.php -->

                            <?php foreach ($reportes as $reporte): ?>
    <tr>
        <td><label>Carnet de Identidad</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="carnetescaneado" data-report-id="<?= $reporte['Idreporte'] ?>">Ver PDF</a>
        </td>
    </tr>
   
         
    </tr>
    <tr>
        <td><label>Ingreso caja PDF</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="ingresocaja" data-report-id="<?= $reporte['Idreporte'] ?>">Ver PDF</a>
        </td>
        
    </tr>
    <tr>
        <td><label>Contrato 1</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="contrato1" data-report-id="<?= $reporte['Idreporte'] ?>">Ver PDF</a>
        </td>
        
    </tr>
    <tr>
        <td><label>Finiquito 1</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="finiquito1" data-report-id="<?= $reporte['Idreporte'] ?>">Ver PDF</a>
        </td>
        
    </tr>
    <tr>
        <td><label>Retiro caja</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="retirocaja" data-report-id="<?= $reporte['Idreporte'] ?>">Ver PDF</a>
        </td>
        
    </tr>
    <!-- Otros tipos de documentos ... -->
    <!-- Otros tipos de documentos ... -->
<?php endforeach; ?>


                               
                                <!-- Add more rows for additional details if needed -->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <?= anchor('Reporte/index', 'Regresar', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">


$("#menureporte").addClass("menu-open");
    $("#reportelista").addClass("active");


    $(document).ready(function () {
    $(".verDocumentoBtn").on("click", function () {
        var documentType = $(this).data("document-type");
        var reportId = $(this).data("report-id");
        verDocumento(documentType, reportId);
    });
});

function verDocumento(documentType, reportId) {
    console.log(reportId);  // Verifica el valor de reportId

    // Verificar si reportId es null o no
    if (reportId !== null && reportId !== 'null') {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('Reporte/getDocumento'); ?>",
            data: { type: documentType, id: reportId },
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    // Crear un Blob a partir del contenido base64
                    var blob = b64toBlob(data.pdfData, 'application/pdf');
                    var blobUrl = URL.createObjectURL(blob);

                    // Abrir la ventana nueva utilizando window.open
                    window.open(blobUrl, '_blank');
                } else {
                    alert("Error fetching PDF: " + data.message);
                }
            },
            error: function () {
                alert("Error fetching PDF");
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


<?= $this->endSection(); ?>
