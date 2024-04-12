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
                    <form action="<?= base_url('consultor_juridico/guardar_edicion_consultoria_j') ?>" method="post">
    <div class="card-body">
        <div class="form-group">
            <label for="nombre_empresa">Nombre de la Empresa</label>
            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" placeholder="Ingrese el nombre de la empresa" value="<?= $consultor->NombreEmpresa_c_p ?>">
        </div>

        <div class="form-group">
            <label for="sigla_empresa">Sigla de la Empresa</label>
            <input type="text" class="form-control" id="sigla_empresa" name="sigla_empresa" placeholder="Ingrese la sigla de la empresa" value="<?= $consultor->SiglaEmpresa_c_p ?>">
        </div>

        <div class="form-group">
            <label for="nit_empresa">NIT de la Empresa</label>
            <input type="text" class="form-control" id="nit_empresa" name="nit_empresa" placeholder="Ingrese el NIT de la empresa" value="<?= $consultor->NITEmpresa_c_p ?>">
        </div>

        <div class="form-group">
            <label for="representante_legal_apellido_paterno">Apellido Paterno del Representante Legal</label>
            <input type="text" class="form-control" id="representante_legal_apellido_paterno" name="representante_legal_apellido_paterno" placeholder="Ingrese el apellido paterno del representante legal" value="<?= $consultor->RepresentanteLegal_ApellidoPaterno_c_p ?>" required>
        </div>

        <div class="form-group">
            <label for="representante_legal_apellido_materno">Apellido Materno del Representante Legal</label>
            <input type="text" class="form-control" id="representante_legal_apellido_materno" name="representante_legal_apellido_materno" placeholder="Ingrese el apellido materno del representante legal" value="<?= $consultor->RepresentanteLegal_ApellidoMaterno_c_p ?>">
        </div>

        <div class="form-group">
            <label for="representante_legal_nombres">Nombres del Representante Legal</label>
            <input type="text" class="form-control" id="representante_legal_nombres" name="representante_legal_nombres" placeholder="Ingrese los nombres del representante legal" value="<?= $consultor->RepresentanteLegal_Nombres_c_p ?>" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio_consultoria">Inicio de Consultoría</label>
            <input type="date" class="form-control" id="fecha_inicio_consultoria" name="fecha_inicio_consultoria" placeholder="Ingrese la fecha de inicio de la consultoría" value="<?= $consultor->FechaInicioConsultoria_c_p ?>" required>
        </div>

        <div class="form-group">
            <label for="fecha_conclusion_consultoria">Conclusión de Consultoría</label>
            <input type="date" class="form-control" id="fecha_conclusion_consultoria" name="fecha_conclusion_consultoria" placeholder="Ingrese la fecha de conclusión de la consultoría" value="<?= $consultor->FechaConclusionConsultoria_c_p ?>">
        </div>

        <div class="form-group">
            <label for="oficina_id">Oficina</label>
            <select class="form-control" id="oficina_id" name="oficina_id" required>
                <?php foreach ($oficinas as $oficina) : ?>
                    <option value="<?= $oficina->id ?>" <?= ($consultor->OficinaID_c_p == $oficina->id) ? 'selected' : '' ?>><?= $oficina->nombre_filial ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="proyecto">Proyecto</label>
            <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Ingrese el nombre del proyecto" value="<?= $consultor->Proyecto_c_p ?>" required>
        </div>

        <div class="form-group">
            <label for="tema_consultoria">Tema de Consultoría</label>
            <input type="text" class="form-control" id="tema_consultoria" name="tema_consultoria" placeholder="Ingrese el tema de la consultoría" value="<?= $consultor->TemaConsultoria_c_p ?>" required>
        </div>

        <div class="form-group">
            <label for="productos_entregados">Productos Entregados</label>
            <input type="text" class="form-control" id="productos_entregados" name="productos_entregados" placeholder="Ingrese los productos entregados" value="<?= $consultor->ProductosEntregados_c_p ?>" required>
        </div>

        <div class="form-group">
            <label for="ubicacion">Ubicación de su Archivo</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingrese la ubicación del archivo" value="<?= $consultor->Archivo_c_p ?>" required>
        </div>

    </div>
    <div class="card-footer">
        <input type="hidden" name="id_consultor" value="<?= $consultor->id_c_p ?>">
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
    $("#listaconulto_juridicor").addClass("active");

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