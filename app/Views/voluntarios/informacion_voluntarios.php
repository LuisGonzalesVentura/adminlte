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
                        <h3 class="card-title h6">Detalles del voluntario</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <?php if ($voluntario): ?>
                                    <tr>
                                        <th class="align-middle">Nº Carnet</th>
                                        <td class="align-middle"><?= $voluntario->carnet_identidad_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Apellido paterno</th>
                                        <td class="align-middle"><?= $voluntario->apellido_paterno_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Apellido materno</th>
                                        <td class="align-middle"><?= $voluntario->apellido_materno_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Nombre(s)</th>
                                        <td class="align-middle"><?= $voluntario->nombres_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Genero</th>
                                        <td class="align-middle"><?= $voluntario->genero_v; ?></td>
                                    </tr>
                                   
                                    <tr>
                                        <th class="align-middle">Inicio Servicio</th>
                                        <td class="align-middle"><?= $voluntario->fecha_inicio_servicio_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Conclusion Servicio</th>
                                        <td class="align-middle"><?= $voluntario->fecha_conclusion_servicio_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Tipo de voluntariado</th>
                                        <td class="align-middle"><?= $voluntario->tipo_voluntariado_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Universidad/Instituto</th>
                                        <td class="align-middle"><?= $voluntario->universidad_instituto_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Carrera/especialidad</th>
                                        <td class="align-middle"><?= $voluntario->carrera_especialidad_v; ?></td>
                                    </tr> 
                                    <tr>
                                        <th class="align-middle">Oficina</th>
                                        <td class="align-middle"><?= $nombreFilial; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Proyecto</th>
                                        <td class="align-middle"><?= $voluntario->proyecto_v; ?></td>
                                    </tr>  <tr>
                                        <th class="align-middle">Área del voluntariado</th>
                                        <td class="align-middle"><?= $voluntario->area_voluntariado_v; ?></td>
                                    </tr>  <tr>
                                        <th class="align-middle">Producto(s) entregado(s)</th>
                                        <td class="align-middle"><?= $voluntario->productos_entregados_v; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Archivo</th>
                                        <td class="align-middle"><?= $voluntario->archivo_v; ?></td>
                                    </tr>
                                    <!-- Agrega más detalles según sea necesario -->
                                    <tr>
                                    <tr>
        <td colspan="2" class="text-center">
            <!-- Coloca aquí tus botones o acciones -->
        </td>
    </tr>
    <td colspan="2" class="text-center">
        <?= anchor('voluntarios/listarVoluntarios', '<i class="ri-arrow-left-circle-fill"></i> Volver', ['class' => 'btn btn-primary btn-sm']); ?>
    </td>
</tr>
<tr>
    <td colspan="2" class="text-center">
        <?php if ($id_voluntario) : ?>
            <a href="<?= base_url('voluntarios/documentos_voluntarios/' . $id_voluntario) ?>" class="btn btn-success btn-sm" type="button"><i class="ri-eye-fill"></i> Ver Documentos</a>
        <?php else : ?>
            No se encontró el voluntario seleccionado.
        <?php endif; ?>
    </td>
</tr>

                                    <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center">No se encontró el voluntario seleccionado.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- Coloca aquí el contenido del pie de página si es necesario -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("#menureporte").addClass("menu-open");
    $("#listaconulto_voluntario").addClass("active");
</script>

<?= $this->endSection(); ?>
