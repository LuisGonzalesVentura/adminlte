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
                    <form action="<?= base_url('voluntarios/guardar_edicion_voluntario') ?>" method="post">
    <div class="card-body">
        <div class="form-group">
            <label for="carnet_identidad">Carnet de Identidad</label>
            <input type="text" class="form-control" id="carnet_identidad" name="carnet_identidad" placeholder="Ingrese el carnet de identidad" value="<?= $voluntario->carnet_identidad_v ?>">
        </div>

        <div class="form-group">
            <label for="apellido_paterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Ingrese el apellido paterno" value="<?= $voluntario->apellido_paterno_v ?>">
        </div>

        <div class="form-group">
            <label for="apellido_materno">Apellido Materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Ingrese el apellido materno" value="<?= $voluntario->apellido_materno_v ?>">
        </div>

        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese los nombres" value="<?= $voluntario->nombres_v ?>">
        </div>

       
        <div class="form-group">
            <label for="genero">Género</label>
            <select class="form-control" id="genero" name="genero" required>
                <option value="Masculino" <?= ($voluntario->genero_v == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                <option value="Femenino" <?= ($voluntario->genero_v == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_inicio_servicio">Inicio de Servicio</label>
            <input type="date" class="form-control" id="fecha_inicio_servicio" name="fecha_inicio_servicio" placeholder="Ingrese la fecha de inicio del servicio" value="<?= $voluntario->fecha_inicio_servicio_v ?>">
        </div>

        <div class="form-group">
            <label for="fecha_conclusion_servicio">Conclusión de Servicio</label>
            <input type="date" class="form-control" id="fecha_conclusion_servicio" name="fecha_conclusion_servicio" placeholder="Ingrese la fecha de conclusión del servicio" value="<?= $voluntario->fecha_conclusion_servicio_v ?>">
        </div>

        <div class="form-group">
    <label for="tipo_voluntariado">Tipo de Voluntariado</label>
    <select class="form-control" id="tipo_voluntariado" name="tipo_voluntariado" required>
        <option value="Pasante" <?= ($voluntario->tipo_voluntariado_v == 'Pasante') ? 'selected' : '' ?>>Pasante</option>
        <option value="Practicante" <?= ($voluntario->tipo_voluntariado_v == 'Practicante') ? 'selected' : '' ?>>Practicante</option>
        <option value="Tesista" <?= ($voluntario->tipo_voluntariado_v == 'Tesista') ? 'selected' : '' ?>>Tesista</option>
        <option value="Independiente" <?= ($voluntario->tipo_voluntariado_v == 'Independiente') ? 'selected' : '' ?>>Independiente</option>
    </select>
</div>


        <div class="form-group">
            <label for="universidad_instituto">Universidad o Instituto</label>
            <input type="text" class="form-control" id="universidad_instituto" name="universidad_instituto" placeholder="Ingrese la universidad o instituto" value="<?= $voluntario->universidad_instituto_v ?>">
        </div>

        <div class="form-group">
            <label for="carrera_especialidad">Carrera o Especialidad</label>
            <input type="text" class="form-control" id="carrera_especialidad" name="carrera_especialidad" placeholder="Ingrese la carrera o especialidad" value="<?= $voluntario->carrera_especialidad_v ?>">
        </div>

        <div class="form-group">
            <label for="id_oficina">Oficina</label>
            <select class="form-control" id="id_oficina" name="id_oficina" required>
                <?php foreach ($oficinas as $oficina) : ?>
                    <option value="<?= $oficina->id ?>" <?= ($voluntario->id_oficina_v == $oficina->id) ? 'selected' : '' ?>><?= $oficina->nombre_filial ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="proyecto">Proyecto</label>
            <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Ingrese el nombre del proyecto" value="<?= $voluntario->proyecto_v ?>">
        </div>

        <div class="form-group">
            <label for="area_voluntariado">Área de Voluntariado</label>
            <input type="text" class="form-control" id="area_voluntariado" name="area_voluntariado" placeholder="Ingrese el área de voluntariado" value="<?= $voluntario->area_voluntariado_v ?>">
        </div>

        <div class="form-group">
            <label for="productos_entregados">Productos Entregados</label>
            <input type="text" class="form-control" id="productos_entregados" name="productos_entregados" placeholder="Ingrese los productos entregados" value="<?= $voluntario->productos_entregados_v ?>">
        </div>

        <div class="form-group">
    <label for="archivo">Archivo</label>
    <input type="text" class="form-control" id="archivo" name="archivo" placeholder="Ingrese el nombre del archivo" value="<?= $voluntario->archivo_v ?>">
</div>
<div class="card-footer">
    <input type="hidden" name="id_voluntario" value="<?= $voluntario->id_voluntario ?>">
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
    $("#listaconulto_voluntario").addClass("active");

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