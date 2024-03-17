<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">RRHH En Planillas</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">RRHH En Planillas</h3>
                    </div>
                    <form action="<?= base_url('Reporte/guardar_reporte') ?>" method='post' enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="Ci">Nº Carnet identidad</label>
                                <input type="text" class="form-control" id="Ci" name="Ci" placeholder="Ingresa Carnet">
                            </div>

                            <div class="form-group">
                                <label for="nua">Nº NUA</label>
                                <input type="text" class="form-control" id="nua" name="nua" placeholder="Ingresa Nua" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido_paterno">Apellido paterno</label>
                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Ingresa apellido paterno" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido_materno">Apellido materno</label>
                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Ingresa apellido materno" >
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre(s)</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="genero">Género</label>
                                <select class="form-control" id="genero" name="genero" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fechaingreso">Fecha ingreso laboral</label>
                                <input type="date" class="form-control" id="fechaingreso" name="fechaingreso" placeholder="Fecha ingreso" required>
                            </div>

                           

                            <div class="form-group">
                                <label for="cargo">Cargo</label>
                                <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Ingresar cargo" required>
                            </div>
                            <div class="form-group">
    <label for="oficina">Oficina</label>
    <select class="form-control" id="oficina" name="oficina" required>
        <?php foreach ($oficinas as $oficina): ?>
            <option value="<?= $oficina->id ?>"><?= $oficina->nombre_filial ?></option>
        <?php endforeach; ?>
    </select>
</div>

                            

                            <div class="form-group">
                                <label for="proyecto">Proyecto</label>
                                <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Ingresar Proyecto" required>
                            </div>
                            <div class="form-group">
                                <label for="fecharetiro">Fecha de retiro laboral</label>
                                <input type="date" class="form-control" id="fecharetiro" name="fecharetiro" placeholder="Fecha retiro">
                            </div>

                            <div class="form-group">
                                <label for="motivo_conclusion">Motivo conclusión laboral</label>
                                <select class="form-control" id="motivo_conclusion" name="motivo_conclusion">
                                <option value="No retirado">No retirado</option>
                                    <option value="Retiro voluntario">Retiro voluntario</option>
                                    <option value="Conclusión contrato">Conclusión contrato</option>
                                    <option value="Incumplimiento de contrato">Incumplimiento de contrato</option>
                                    <option value="Despido intempestivo">Despido intempestivo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ubicacion">Ubicación de su archivo</label>
                                <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresa la ubicación" required>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("#menureporte").addClass("menu-open");
    $("#crearreporte").addClass("active");

    <?php if (session()->has('success_message')): ?>
        Swal.fire({
            title: 'Éxito',
            text: '<?= session('success_message') ?>',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    <?php elseif (session()->has('error_message')): ?>
        Swal.fire({
            title: 'Error',
            text: '<?= session('error_message') ?>',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    <?php endif  ?>
    </script>
    
    <?= $this->endSection(); ?>
    