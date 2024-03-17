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
                    <li class="breadcrumb-item active">Crear Consultores Persona Natural</li>
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
                        <h3 class="card-title">Crear Consultores Persona Natural</h3>
                    </div>
                    <form action="<?= base_url('consultores/guardar_consultor_natural') ?>" method='post' enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="carnet_identidad_n">Nº Carnet identidad</label>
                                <input type="text" class="form-control" id="carnet_identidad_n" name="carnet_identidad_n" placeholder="Ingresa Carnet">
                            </div>

                            <div class="form-group">
                                <label for="nua_n">Nº NUA</label>
                                <input type="text" class="form-control" id="nua_n" name="nua_n" placeholder="Ingresa NUA" required>
                            </div>
                            <div class="form-group">
                                <label for="nit_n">Nº NIT</label>
                                <input type="text" class="form-control" id="nit_n" name="nit_n" placeholder="Ingresa NIT" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido_paterno_n">Apellido paterno</label>
                                <input type="text" class="form-control" id="apellido_paterno_n" name="apellido_paterno_n" placeholder="Ingresa apellido paterno" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido_materno_n">Apellido materno</label>
                                <input type="text" class="form-control" id="apellido_materno_n" name="apellido_materno_n" placeholder="Ingresa apellido materno" required>
                            </div>

                            <div class="form-group">
                                <label for="nombres_n">Nombre(s)</label>
                                <input type="text" class="form-control" id="nombres_n" name="nombres_n" placeholder="Ingresar nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="genero_n">Género</label>
                                <select class="form-control" id="genero_n" name="genero_n" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inicio_servicio_n">Fechas de inicio servicio consultoria</label>
                                <input type="date" class="form-control" id="inicio_servicio_n" name="inicio_servicio_n" placeholder="Fecha ingreso" required>
                            </div>

                            

                            <div class="form-group">
                                <label for="conclusion_servicio_n">Fechas de conclusion servicio consultoria</label>
                                <input type="date" class="form-control" id="conclusion_servicio_n" name="conclusion_servicio_n" placeholder="Fecha retiro">
                            </div>
                            <div class="form-group">
    <label for="oficina_id">Oficina</label>
    <select class="form-control" id="oficina_id" name="oficina_id" required>
        <?php foreach ($oficinas as $oficina): ?>
            <option value="<?= $oficina->id ?>"><?= $oficina->nombre_filial ?></option>
        <?php endforeach; ?>
    </select>
</div>



                            <div class="form-group">
                                <label for="proyecto_n">Proyecto</label>
                                <input type="text" class="form-control" id="proyecto_n" name="proyecto_n" placeholder="Ingresar Proyecto" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="tema_consultoria_n">Tema de la consultoria</label>
                                <input type="text" class="form-control" id="tema_consultoria_n" name="tema_consultoria_n" placeholder="Ingresar tema de ka consultoria" required>
                            </div>
                            <div class="form-group">
                                <label for="productos_entregados_n">Producto(s) entregado</label>
                                <input type="text" class="form-control" id="productos_entregados_n" name="productos_entregados_n" placeholder="Ingresar productos entregados" >
                            </div>

                            <div class="form-group">
                                <label for="ubicacion_n">Ubicacion del archivo</label>
                                <input type="text" class="form-control" id="ubicacion_n" name="ubicacion_n" placeholder="Ingresar ubicacion del archivo" required>
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
    $("#vista_formulario_crear_consultores_natural").addClass("active");

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
    