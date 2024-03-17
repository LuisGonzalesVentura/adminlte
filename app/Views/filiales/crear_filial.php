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
                    <li class="breadcrumb-item active">Crear filial</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Filial nuevo</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                      <!-- form start -->
<form action="<?= base_url('Oficinas/crearFilial') ?>" method='post' enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="nombre_filial">Nombre de Filial</label>
            <input type="text" class="form-control" id="nombre_filial" name="nombre_filial" placeholder="Ingresar nombre de la filial" required>
        </div>
       
        <!-- Puedes agregar otros campos aquí según sea necesario -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Crear</button>
    </div>
</form>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->

    <script type="text/javascript">
        $("#menuoficinas").addClass("menu-open");
        $("#crear_filial").addClass("active");


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