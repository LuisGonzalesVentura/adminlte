<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $titulo; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Editar Reporte</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Editar Reporte</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url('Reporte/guardar_edicion') ?>" method='post' enctype="multipart/form-data" id="editarForm">
    <div class="card-body">
        <div class="form-group">
            <label for="Ci">Nº Carnet identidad</label>
            <input type="text" class="form-control" id="Ci" name="Ci" placeholder="Ingresa Carnet" value="<?= $reporte->Ci ?>">
        </div>

        <div class="form-group">
            <label for="nua">Nº NUA</label>
            <input type="text" class="form-control" id="nua" name="nua" placeholder="Ingresa Nua" value="<?= $reporte->nua ?>" required>
        </div>

        <div class="form-group">
            <label for="apellido_paterno">Apellido paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Ingresa apellido paterno" value="<?= $reporte->apellido ?>" required>
        </div>

        <div class="form-group">
            <label for="apellido_materno">Apellido materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Ingresa apellido materno" value="<?= $reporte->apellido_materno ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre(s)</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre" value="<?= $reporte->nombre ?>" required>
        </div>

        <div class="form-group">
            <label for="genero">Género</label>
            <select class="form-control" id="genero" name="genero" required>
                <option value="Masculino" <?= ($reporte->genero == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                <option value="Femenino" <?= ($reporte->genero == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fechaingreso">Fecha ingreso laboral</label>
            <input type="date" class="form-control" id="fechaingreso" name="fechaingreso" placeholder="Fecha ingreso" value="<?= $reporte->fechaingreso ?>" required>
        </div>

        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Ingresar cargo" value="<?= $reporte->cargo ?>" required>
        </div>

        <div class="form-group">
            <label for="oficina">Oficina</label>
            <select class="form-control" id="oficina" name="oficina" required>
                <?php foreach ($oficinas as $oficina) : ?>
                    <option value="<?= $oficina->id ?>" <?= (property_exists($reporte, 'id_oficina') && $oficina->id == $reporte->id_oficina) ? 'selected' : '' ?>><?= $oficina->nombre_filial ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="proyecto">Proyecto</label>
            <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Ingresar Proyecto" value="<?= $reporte->proyecto ?>" required>
        </div>

        <div class="form-group">
    <label for="fecharetiro">Fecha de retiro laboral</label>
    <input type="date" class="form-control" id="fecharetiro" name="fecharetiro" placeholder="Fecha retiro" value="<?= isset($reporte->fechafin) ? $reporte->fechafin : '' ?>">
</div>


        

        <div class="form-group">
            <label for="motivo_conclusion">Motivo conclusión laboral</label>
            <select class="form-control" id="motivo_conclusion" name="motivo_conclusion">
                <option value="No retirado" <?= ($reporte->motivo_conclusion == 'No retirado') ? 'selected' : '' ?>>No retirado</option>
                <option value="Retiro voluntario" <?= ($reporte->motivo_conclusion == 'Retiro voluntario') ? 'selected' : '' ?>>Retiro voluntario</option>
                <option value="Conclusión contrato" <?= ($reporte->motivo_conclusion == 'Conclusión contrato') ? 'selected' : '' ?>>Conclusión contrato</option>
                <option value="Incumplimiento de contrato" <?= ($reporte->motivo_conclusion == 'Incumplimiento de contrato') ? 'selected' : '' ?>>Incumplimiento de contrato</option>
                <option value="Despido intempestivo" <?= ($reporte->motivo_conclusion == 'Despido intempestivo') ? 'selected' : '' ?>>Despido intempestivo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ubicacion">Ubicación de su archivo</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresa la ubicación" value="<?= $reporte->ubicacion ?>" required>
        </div>

    </div>
    <div class="card-footer">
        <input type="hidden" name="id_reporte" value="<?= $reporte->Idreporte ?>">
        <button type="submit" class="btn btn-primary">Guardar Edición</button>
    </div>
</form>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $("#menureporte").addClass("menu-open");
    $("#editar_reporte").addClass("active");

    function mostrarAlerta() {
        Swal.fire({
            title: 'Éxito',
            icon: 'success',
            timer: 5000, // 5000 milisegundos = 5 segundos
            showConfirmButton: false
        });
    }
</script>




    <?= $this->endSection(); ?>