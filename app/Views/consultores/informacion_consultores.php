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
                        <h3 class="card-title h6">Detalles del consultor</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                <?php if ($consultor): ?>
    <tr>
        <th class="align-middle"> Nº NUA</th>
        <td class="align-middle"><?= $consultor->nua_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Nº Carnet</th>
        <td class="align-middle"><?= $consultor->carnet_identidad_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Nº NIT</th>
        <td class="align-middle"><?= $consultor->nit_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Apellido paterno</th>
        <td class="align-middle"><?= $consultor->apellido_paterno_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Apellido materno</th>
        <td class="align-middle"><?= $consultor->apellido_materno_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Nombre(s)</th>
        <td class="align-middle"><?= $consultor->nombres_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Genero</th>
        <td class="align-middle"><?= $consultor->genero_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Fechas de inicio servicio consultoria</th>
        <td class="align-middle"><?= $consultor->inicio_servicio_n; ?></td>
    </tr>
    <tr>
    <th class="align-middle">Oficina</th>
    <td class="align-middle"><?= $nombreFilial; ?></td>
</tr>

    <tr>
        <th class="align-middle">Proyecto</th>
        <td class="align-middle"><?= $consultor->proyecto_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Fechas de conclusion servicio consultoria</th>
        <td class="align-middle"><?= $consultor->conclusion_servicio_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Tema de la consultoria</th>
        <td class="align-middle"><?= $consultor->tema_consultoria_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Producto(s) entregado</th>
        <td class="align-middle"><?= $consultor->productos_entregados_n; ?></td>
    </tr>
    <tr>
        <th class="align-middle">Ubicacion del archivo</th>
        <td class="align-middle"><?= $consultor->ubicacion_n; ?></td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <!-- Coloca aquí tus botones u acciones -->
        </td>
    </tr>
    
    <tr>
    <td colspan="2" class="text-center">
        <?= anchor('consultores/listarConsultores_n', '<i class="ri-arrow-left-circle-fill"></i> Volver', ['class' => 'btn btn-primary btn-sm']); ?>
    </td>
</tr>
<td colspan="2" class="text-center">
    <?php if ($id) : ?>
        <a href="<?= base_url('Consultores/documentos_consultores_n/' . $id) ?>" class="btn btn-success btn-sm" type="button"><i class="ri-eye-fill"></i> Ver Documentos</a>
    <?php else : ?>
        No se encontró el consultor seleccionado.
    <?php endif; ?>
</td>


<?php else: ?>
    <tr>
        <td colspan="2" class="text-center">No se encontró el consultor seleccionado.</td>
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
    $("#listaconultor").addClass("active");
</script>

<?= $this->endSection(); ?>
