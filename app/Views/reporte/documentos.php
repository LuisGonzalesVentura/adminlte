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
                            <!-- En la vista documentos.php -->

                            <?php foreach ($reportes as $reporte): ?>
                                

                                <h2>Archivos de:  <?= $reporte->nombre . ' ' . $reporte->apellido. ' ' . $reporte->apellido_materno; ?></h2>
    <tr>
        <td><label>Acta de selección</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="acta_de_seleccion" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
    </tr>


    <tr>
        <td><label>Informe exámen psicológico</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="informe_examen_psicologico" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
    </tr>

    <tr>
        <td><label>Carnet de Identidad</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="carnetescaneado" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
    </tr>
   
   
    <tr>
        <td><label>Certificado de antecedentes penales</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="certificado_de_antecedentes_penales" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
    </tr>
    <tr>
        <td><label>Certificado de No violencia</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="certificado_de_no_violencia" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
    </tr>
    <tr>
        <td><label>Currículum vite</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="curriculum_vitae" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
    </tr>
    <tr>
        <td><label>Memorandum asignación del cargo</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="memorandum_asignacion_del_cargo" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
    </tr>
    
    
    <tr>
        <td><label>Formulario parte ingreso CPS</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="ingresocaja" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
        
    </tr>
    <tr>
        <td><label>Carnet asegurdo CPS</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="carnet_de_asegurado_cps" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
        
    </tr>
    <tr>
        <td><label>Formulario aporte seguro a largo plazo</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="formulario_aporte_seguro_a_largo_plazo" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
        
    </tr>
  
  
    
    <tr>
        <td><label>Formulario desvinculación</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="formulario_de_desvinculacion" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
        </td>
        
    </tr>

    <tr>
        <td><label>Certificado de trabajo</label></td>
        <td>
            <a href="javascript:void(0);" class="btn btn-primary verDocumentoBtn" data-document-type="certificado_trabajo" data-report-id="<?= $reporte->Idreporte ?>"><i class="ri-eye-fill"></i></a>
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
                        <?= anchor('Reporte/index', '<i class="ri-arrow-left-circle-fill"></i>', ['class' => 'btn btn-primary']); ?>
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
