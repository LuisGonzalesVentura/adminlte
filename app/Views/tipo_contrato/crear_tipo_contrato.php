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
                    <li class="breadcrumb-item active">Crear nuevo contrato</li>
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
                        <h3 class="card-title">Crear nuevo contrato</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('tipocontratos/crearContrato') ?>" method='post' enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nombre_contrato">Nombre del nuevo contrato</label>
                                    <input type="text" class="form-control" id="nombre_contrato" name="nombre_contrato" placeholder="Ingresar nombre del nuevo contrato" required>
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
    </div>
</section>

    <!-- /.content -->

    <script type="text/javascript">
        $("#menucontratos").addClass("menu-open");
        $("#crear_contrato").addClass("active");


    </script>
    <script type="text/javascript">
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