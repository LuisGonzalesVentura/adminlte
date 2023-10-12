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
              <li class="breadcrumb-item active">Eliminar usuario</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
        <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Usuarios</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre completo</th>
                            
                            <th>Acción</th> <!-- Agregamos la columna de acciones -->
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
    <td>183</td>
    <td>John Doe</td>
    <td>
        <a href="#" class="btn btn-danger">Eliminar</a>
    </td>
</tr>

                        <!-- Repite esta estructura para cada fila de datos -->
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>


    </section>
    <!-- /.content -->

    <script type="text/javascript">
    $("#menuAdministracion").addClass("menu-open");
    $("#eliminarUsuarios").addClass("active");

</script>
    <?=$this->endSection(); ?>