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
                    <form action="<?= base_url('consultor_juridico/guardar_consultor_juridica') ?>" method='post' enctype="multipart/form-data">
    <div class="card-body">

        <div class="form-group">
            <label for="NombreEmpresa_c_p">Nombre de la Empresa</label>
            <input type="text" class="form-control" id="NombreEmpresa_c_p" name="NombreEmpresa_c_p" placeholder="Ingrese Nombre de la Empresa" required>
        </div>

        <div class="form-group">
            <label for="SiglaEmpresa_c_p">Sigla de la Empresa</label>
            <input type="text" class="form-control" id="SiglaEmpresa_c_p" name="SiglaEmpresa_c_p" placeholder="Ingrese Sigla de la Empresa" required>
        </div>

        <div class="form-group">
            <label for="NITEmpresa_c_p">NIT de la Empresa</label>
            <input type="text" class="form-control" id="NITEmpresa_c_p" name="NITEmpresa_c_p" placeholder="Ingrese NIT de la Empresa" required>
        </div>

        <div class="form-group">
            <label for="RepresentanteLegal_ApellidoPaterno_c_p">Apellido paterno del Representante Legal</label>
            <input type="text" class="form-control" id="RepresentanteLegal_ApellidoPaterno_c_p" name="RepresentanteLegal_ApellidoPaterno_c_p" placeholder="Ingrese Apellido Paterno del Representante Legal" required>
        </div>

        <div class="form-group">
            <label for="RepresentanteLegal_ApellidoMaterno_c_p">Apellido materno del Representante Legal</label>
            <input type="text" class="form-control" id="RepresentanteLegal_ApellidoMaterno_c_p" name="RepresentanteLegal_ApellidoMaterno_c_p" placeholder="Ingrese Apellido Materno del Representante Legal">
        </div>

        <div class="form-group">
            <label for="RepresentanteLegal_Nombres_c_p">Nombre(s) del Representante Legal</label>
            <input type="text" class="form-control" id="RepresentanteLegal_Nombres_c_p" name="RepresentanteLegal_Nombres_c_p" placeholder="Ingrese Nombre(s) del Representante Legal" required>
        </div>

        <div class="form-group">
            <label for="FechaInicioConsultoria_c_p">Fecha de Inicio de la Consultoría</label>
            <input type="date" class="form-control" id="FechaInicioConsultoria_c_p" name="FechaInicioConsultoria_c_p" required>
        </div>

        <div class="form-group">
            <label for="FechaConclusionConsultoria_c_p">Fecha de Conclusión de la Consultoría</label>
            <input type="date" class="form-control" id="FechaConclusionConsultoria_c_p" name="FechaConclusionConsultoria_c_p">
        </div>

        <div class="form-group">
            <label for="OficinaID_c_p">Oficina</label>
            <select class="form-control" id="OficinaID_c_p" name="OficinaID_c_p" required>
                <?php foreach ($oficinas as $oficina): ?>
                    <option value="<?= $oficina->id ?>"><?= $oficina->nombre_filial ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="Proyecto_c_p">Proyecto</label>
            <input type="text" class="form-control" id="Proyecto_c_p" name="Proyecto_c_p" placeholder="Ingrese Proyecto" required>
        </div>

        <div class="form-group">
            <label for="TemaConsultoria_c_p">Tema de la Consultoría</label>
            <input type="text" class="form-control" id="TemaConsultoria_c_p" name="TemaConsultoria_c_p" placeholder="Ingrese Tema de la Consultoría" required>
        </div>

        <div class="form-group">
            <label for="ProductosEntregados_c_p">Producto(s) Entregado(s)</label>
            <input type="text" class="form-control" id="ProductosEntregados_c_p" name="ProductosEntregados_c_p" placeholder="Ingrese Producto(s) Entregado(s)">
        </div>

        <div class="form-group">
            <label for="Archivo_c_p">Ubicación del Archivo</label>
            <input type="text" class="form-control" id="Archivo_c_p" name="Archivo_c_p" placeholder="Ingrese Ubicación del Archivo" required>
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
    $("#vista_formulario_crear_consultores_juridico").addClass("active");

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
    