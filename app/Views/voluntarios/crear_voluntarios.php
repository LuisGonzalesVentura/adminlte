<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $titulo; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Crear Voluntarios</li>
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
                        <h3 class="card-title">Crear Voluntarios</h3>
                    </div>
                    <form action="<?= base_url('voluntarios/guardar_voluntario') ?>" method='post' enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="carnet_identidad_v">Carnet de Identidad</label>
                                <input type="text" class="form-control" id="carnet_identidad_v" name="carnet_identidad_v" placeholder="Ingrese Carnet de Identidad" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_paterno_v">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellido_paterno_v" name="apellido_paterno_v" placeholder="Ingrese Apellido Paterno" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_materno_v">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellido_materno_v" name="apellido_materno_v" placeholder="Ingrese Apellido Materno">
                            </div>
                            <div class="form-group">
                                <label for="nombres_v">Nombres</label>
                                <input type="text" class="form-control" id="nombres_v" name="nombres_v" placeholder="Ingrese Nombres" required>
                            </div>
                            <div class="form-group">
                                <label for="genero_v">Género</label>
                                <select class="form-control" id="genero_v" name="genero_v" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_inicio_servicio_v">Fecha de Inicio del Servicio</label>
                                <input type="date" class="form-control" id="fecha_inicio_servicio_v" name="fecha_inicio_servicio_v" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_conclusion_servicio_v">Fecha de Conclusión del Servicio</label>
                                <input type="date" class="form-control" id="fecha_conclusion_servicio_v" name="fecha_conclusion_servicio_v">
                            </div>
                            <div class="form-group">
                                <label for="tipo_voluntariado_v">Tipo de Voluntariado</label>
                                <select class="form-control" id="tipo_voluntariado_v" name="tipo_voluntariado_v" required>
                                    <option value="Pasante">Pasante</option>
                                    <option value="Practicante">Practicante</option>
                                    <option value="Tesista">Tesista</option>
                                    <option value="Independiente">Independiente</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="universidad_instituto_v">Universidad o Instituto</label>
                                <input type="text" class="form-control" id="universidad_instituto_v" name="universidad_instituto_v" placeholder="Ingrese Universidad o Instituto" required>
                            </div>
                            <div class="form-group">
                                <label for="carrera_especialidad_v">Carrera o Especialidad</label>
                                <input type="text" class="form-control" id="carrera_especialidad_v" name="carrera_especialidad_v" placeholder="Ingrese Carrera o Especialidad" required>
                            </div>
                            <div class="form-group">
                                <label for="id_oficina_v">Oficina</label>
                                <select class="form-control" id="id_oficina_v" name="id_oficina_v" required>
                                    <?php foreach ($oficinas as $oficina): ?>
                                        <option value="<?= $oficina->id ?>">
                                         <?= $oficina->nombre_filial ?>
                                        </option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="proyecto_v">Proyecto</label>
                                <input type="text" class="form-control" id="proyecto_v" name="proyecto_v" placeholder="Ingrese Proyecto" required>
                            </div>
                            <div class="form-group">
                                <label for="area_voluntariado_v">Área de Voluntariado</label>
                                <input type="text" class="form-control" id="area_voluntariado_v" name="area_voluntariado_v" placeholder="Ingrese Área de Voluntariado">
                            </div>
                            <div class="form-group">
                                <label for="productos_entregados_v">Producto(s) Entregado(s)</label>
                                <input type="text" class="form-control" id="productos_entregados_v" name="productos_entregados_v" placeholder="Ingrese Producto(s) Entregado(s)">
                            </div>
                            <div class="form-group">
                                <label for="archivo_v">Ubicación del Archivo</label>
                                <input type="text" class="form-control" id="archivo_v" name="archivo_v" placeholder="Ingrese Ubicación del Archivo" required>
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
    $("#vista_formulario_crear_voluntarios").addClass("active");

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
