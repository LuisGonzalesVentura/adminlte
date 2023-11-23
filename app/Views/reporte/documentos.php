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
                            <tr>
                             <td><label>Carnet de Identidad  </label></td>
                             <td>
                             <button class="btn btn-primary" onclick="verDocumento('Carnetescaneado')">Ver PDF</button>
                          </td>
                             </tr>
                                <tr>
                                    <td><label>Ingreso a caja</label></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="verDocumento('ingresoCaja')">Ver PDF</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Contratos</label></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="verDocumento('contratos')">Ver PDF</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Finiquitos</label></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="verDocumento('finiquitos')">Ver PDF</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Retiro caja</label></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="verDocumento('retiroCaja')">Ver PDF</button>
                                    </td>
                                </tr>
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

                // Abrir la ventana nueva utilizando window.location.href
                window.location.href = blobUrl;
            } else {
                alert("Error fetching PDF");
            }
        },
        error: function () {
            alert("Error fetching PDF");
        }
    });
}


// Función para convertir base64 a Blob
function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;

    var byteCharacters = atob(b64Data);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }

    return new Blob(byteArrays, { type: contentType });
}

</script>



<?= $this->endSection(); ?>
