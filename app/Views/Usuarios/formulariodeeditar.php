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
                    <form action="<?php echo 'http://localhost/adminlte/public/FormularioDeEditar/editarUsuario/'.$id?>" method='post' enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputnombre">Nombre</label>
                                <input name="nombre" type="nombre" class="form-control" id="exampleInputEmail1" placeholder="Ingresar nombre" value="<?php echo $user['nombre']?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputapellido">Apellido</label>
                                <input name="apellido" class="form-control" id="exampleInputPassword1" placeholder="Ingresa apellidos" value="<?php echo $user['apellido']?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresa email" value="<?php echo $user['email']?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsuario">Usuario</label>
                                <input name="usuario" class="form-control" id="exampleInputEmail1" placeholder="Ingresa usuario" value="<?php echo $user['usuario']?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña</label>
                                <input name="contrasena" type="password" class="form-control" id="exampleInputPassword1" placeholder="contraseña" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha nacimiento</label>
                                <input name="fecha_nacimiento"type="date" class="form-control" id="exampleInputEmail1" placeholder="Fecha nacimiento" value="<?php echo $user['fecha_nacimiento']?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputFile">Foto</label></br>
                                <label><?php echo "Archivo:".$user['foto']?></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="fotoUsuario" type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">foto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Numero</label>
                                <input  class="form-control" id="exampleInputPassword1" placeholder="Numero" value="<?php echo $user['numero']?>">
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