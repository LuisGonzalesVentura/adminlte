<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h5"><?= $titulo; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Reportes RRHH En Planillas</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title h6">Detalles del consultor jurídico</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                <?php if ($consultor): ?>
                                    <tr>
        <th class="align-middle">Nombre de la empresa</th>
        <td class="align-middle"><?= $consultor->NombreEmpresa_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Sigla de la empresa</th>
        <td class="align-middle"><?= $consultor->SiglaEmpresa_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Nº NIT</th>
        <td class="align-middle"><?= $consultor->NITEmpresa_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Apellido paterno representante legal</th>
        <td class="align-middle"><?= $consultor->RepresentanteLegal_ApellidoPaterno_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Apellido materno representante legal</th>
        <td class="align-middle"><?= $consultor->RepresentanteLegal_ApellidoMaterno_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Nombre(s) representante legal</th>
        <td class="align-middle"><?= $consultor->RepresentanteLegal_Nombres_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Fechas de inicio servicio consultoría</th>
        <td class="align-middle"><?= $consultor->FechaInicioConsultoria_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Fechas de conclusión servicio consultoría</th>
        <td class="align-middle"><?= $consultor->FechaConclusionConsultoria_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Oficina</th>
        <td class="align-middle"><?= $nombreFilial; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Proyecto</th>
        <td class="align-middle"><?= $consultor->Proyecto_c_p; ?></td>
    </tr>
    
    <tr>
        <th class="align-middle">Tema de la consultoría</th>
        <td class="align-middle"><?= $consultor->TemaConsultoria_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Producto(s) entregado(s)</th>
        <td class="align-middle"><?= $consultor->ProductosEntregados_c_p; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Archivo</th>
        <td class="align-middle"><?= $consultor->Archivo_c_p; ?></td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <!-- Coloca aquí tus botones o acciones -->
        </td>
    </tr>
    
    <tr>
        <td colspan="2" class="text-center">
            <?= anchor('consultor_juridico/listarConsultoresJuridicos', '<i class="ri-arrow-left-circle-fill"></i> Volver', ['class' => 'btn btn-primary btn-sm']); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <?php if ($id) : ?>
                <a href="<?= base_url('consultor_juridico/documentos_consultores_J/' . $id) ?>" class="btn btn-success btn-sm" type="button"><i class="ri-eye-fill"></i> Ver Documentos</a>
            <?php else : ?>
                No se encontró el consultor jurídico seleccionado.
            <?php endif; ?>
        </td>
    </tr>
<?php else: ?>
    <tr>
        <td colspan="2" class="text-center">No se encontró el consultor jurídico seleccionado.</td>
    </tr>
<?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- Add footer content if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("#menureporte").addClass("menu-open");
    $("#listaconulto_juridicor").addClass("active");
</script>

<?= $this->endSection(); ?>
