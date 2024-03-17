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
                        <h3 class="card-title h6">Detalles del Reporte RRHH En Planillas</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                <?php if ($reporte): ?>
                                        <tr>
                                            <th class="align-middle"> Nº NUA</th>
                                            <td class="align-middle"><?= $reporte->nua; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Nº Carnet</th>
                                            <td class="align-middle"><?= $reporte->Ci; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">ID</th>
                                            <td class="align-middle"><?= $reporte->Idreporte; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Apellido paterno</th>
                                            <td class="align-middle"><?= $reporte->apellido; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Apellido materno</th>
                                            <td class="align-middle"><?= $reporte->apellido_materno; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Nombre(s)</th>
                                            <td class="align-middle"><?= $reporte->nombre; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Genero</th>
                                            <td class="align-middle"><?= $reporte->genero; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Fecha ingreso laboral</th>
                                            <td class="align-middle"><?= $reporte->fechaingreso; ?></td>
                                        </tr>
                                     
<tr>
    <th class="align-middle">Oficina</th>
    <td class="align-middle"><?= isset($reporte->oficina->nombre_filial) ? $reporte->oficina->nombre_filial : 'N/A'; ?></td>
</tr>


                                
                                        <tr>
                                            <th class="align-middle">Cargo</th>
                                            <td class="align-middle"><?= $reporte->cargo; ?></td>
                                        </tr>
                                       
                                        <tr>
                                            <th class="align-middle">Proyecto</th>
                                            <td class="align-middle"><?= $reporte->proyecto; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Fecha retiro laboral</th>
                                            <td class="align-middle"><?= $reporte->fechafin; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Motivo conclusion laboral</th>
                                            <td class="align-middle"><?= $reporte->motivo_conclusion; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Ubicacion del archivo</th>
                                            <td class="align-middle"><?= $reporte->ubicacion; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <a href="<?= base_url('Reporte/documentos/' . $reporte->Idreporte) ?>" class="btn btn-success btn-sm" type="button"><i class="ri-eye-fill"></i></a>
                                                <?= anchor('Reporte/index', '<i class="ri-arrow-left-circle-fill"></i>', ['class' => 'btn btn-primary btn-sm']); ?>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            
                                        <a href="<?= base_url('Consultores/documentos/' . $consultor->id) ?>" class="btn btn-success btn-sm" type="button"><i class="ri-eye-fill"></i> Ver Documentos</a>

                                            <td colspan="2" class="text-center">No se encontró el reporte seleccionado.</td>
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
    $("#reportelista").addClass("active");
</script>

<?= $this->endSection(); ?>
