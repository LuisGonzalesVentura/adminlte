<?=$this->extend('Views/Dashboard/escritorio'); ?>


<?=$this->section('contenido'); ?>


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
              <li class="breadcrumb-item active">Formulario Editar Usuarios</li>
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
                        <h3 class="card-title">Usuario Nuevo</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputnombre">Nombre</label>
                                <input name="nombre" type="nombre" class="form-control" id="exampleInputEmail1" placeholder="Ingresar nombre">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputapellido">Apellido</label>
                                <input type="apellido" class="form-control" id="exampleInputPassword1" placeholder="Ingresa apellidos">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresa email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsuario">Usuario</label>
                                <input type="usuario" class="form-control" id="exampleInputEmail1" placeholder="Ingresa usuario">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="contraseña">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha nacimiento</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Fecha nacimiento">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">foto</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Subir</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Numero</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Numero">
                            </div>
                            
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Editar</button>
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
    $("#menuAdministracion").addClass("menu-open");
    $("#menuUsuarios").addClass("active");

</script>
    <?=$this->endSection(); ?>