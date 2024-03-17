

<?= $this->extend('Views/Dashboard/escritorio'); ?>

<?= $this->section('contenido'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Editar contrato</li>
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
                        <h3 class="card-title">Editar contrato</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
         <!-- Vista filiales/formulario_de_modificacion -->
<!-- Agrega este formulario en tu vista para editar el contrato -->
<form action="<?= base_url('contrato/editarContrato/' . $contrato['idcontrato_c']) ?>" method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="fecha_de_inicio">Fecha inicio contrato</label>
                <input type="date" class="form-control" name="fecha_de_inicio" value="<?= $contrato['fecha_inicio_contrato_c'] ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_de_finalizacion">Fecha finalización contrato</label>
                <input type="date" class="form-control" name="fecha_de_finalizacion" value="<?= $contrato['fecha_finalizacion_contrato_c'] ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_archivo">Nuevo Archivo</label>
                <input type="file" class="form-control" name="nuevo_archivo">
            </div>

            <!-- Otros campos del contrato si es necesario -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</form>




                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>



<script type="text/javascript">
    $("#menucontratospdff").addClass("menu-open");
    $("#lista_ccontratosss").addClass("active");

    document.getElementById('editarForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe automáticamente

        Swal.fire({
            title: '¿Desea modificar la oficina?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario hace clic en "Sí", enviar el formulario
                document.getElementById('editarForm').submit();
            }
        });
    });

    <?php if (session()->has('success_message')): ?>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: '<?= session('success_message') ?>',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    <?php elseif (session()->has('error_message')): ?>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: '<?= session('error_message') ?>',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    <?php endif; ?>
</script>


    <?= $this->endSection(); ?>