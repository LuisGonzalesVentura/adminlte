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
                    <form action="<?= base_url('Consultores/guardar_edicion_consultoria_n') ?>" method="post">
    <div class="card-body">
        <div class="form-group">
            <label for="carnet_identidad">Nº Carnet identidad</label>
            <input type="text" class="form-control" id="carnet_identidad" name="carnet_identidad" placeholder="Ingresa Carnet" value="<?= $consultor->carnet_identidad_n ?>">
        </div>

        <div class="form-group">
            <label for="nua">Nº NUA</label>
            <input type="text" class="form-control" id="nua" name="nua" placeholder="Ingresa Nua" value="<?= $consultor->nua_n ?>" required>
        </div>
        <div class="form-group">
            <label for="nit_n">Nº Nit</label>
            <input type="text" class="form-control" id="nit_n" name="nit_n" placeholder="Ingresa Nua" value="<?= $consultor->nit_n ?>" required>
        </div>

        <div class="form-group">
            <label for="apellido_paterno">Apellido paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Ingresa apellido paterno" value="<?= $consultor->apellido_paterno_n ?>" required>
        </div>

        <div class="form-group">
            <label for="apellido_materno">Apellido materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Ingresa apellido materno" value="<?= $consultor->apellido_materno_n ?>" >
        </div>

        <div class="form-group">
            <label for="nombres">Nombre(s)</label>
            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingresar nombre" value="<?= $consultor->nombres_n ?>" required>
        </div>

        <div class="form-group">
            <label for="genero">Género</label>
            <select class="form-control" id="genero" name="genero" required>
                <option value="Masculino" <?= ($consultor->genero_n == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                <option value="Femenino" <?= ($consultor->genero_n == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
            </select>
        </div>

        <div class="form-group">
            <label for="inicio_servicio">Inicio de servicio</label>
            <input type="date" class="form-control" id="inicio_servicio" name="inicio_servicio" placeholder="Inicio de servicio" value="<?= $consultor->inicio_servicio_n ?>" required>
        </div>

        <div class="form-group">
            <label for="conclusion_servicio">Conclusión de servicio</label>
            <input type="date" class="form-control" id="conclusion_servicio" name="conclusion_servicio" placeholder="Conclusión de servicio" value="<?= $consultor->conclusion_servicio_n ?>">
        </div>

        <div class="form-group">
            <label for="oficina_id">Oficina</label>
            <select class="form-control" id="oficina_id" name="oficina_id" required>
                <?php foreach ($oficinas as $oficina) : ?>
                    <option value="<?= $oficina->id ?>" <?= ($consultor->oficina_id == $oficina->id) ? 'selected' : '' ?>><?= $oficina->nombre_filial ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="proyecto">Proyecto</label>
            <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Ingresar Proyecto" value="<?= $consultor->proyecto_n ?>" required>
        </div>

        <div class="form-group">
            <label for="tema_consultoria">Tema de consultoría</label>
            <input type="text" class="form-control" id="tema_consultoria" name="tema_consultoria" placeholder="Tema de consultoría" value="<?= $consultor->tema_consultoria_n ?>" required>
        </div>

        <div class="form-group">
            <label for="productos_entregados">Productos entregados</label>
            <input type="text" class="form-control" id="productos_entregados" name="productos_entregados" placeholder="Productos entregados" value="<?= $consultor->productos_entregados_n ?>" required>
        </div>

        <div class="form-group">
            <label for="ubicacion">Ubicación de su archivo</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresa la ubicación" value="<?= $consultor->ubicacion_n ?>" required>
        </div>

    </div>
    <div class="card-footer">
    <input type="hidden" name="id_consultor" value="<?= $consultor->consultoria_id_n ?>">
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
    $("#listaconultor").addClass("active");

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