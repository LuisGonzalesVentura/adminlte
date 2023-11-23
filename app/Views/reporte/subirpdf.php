<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<?= $this->extend('Views/Dashboard/escritorio'); ?>


<?= $this->section('contenido'); ?>

  <link rel="icon" type="image/png" href="LogoDNI.png" />

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
          <li class="breadcrumb-item active">Subir PDFs</li>
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
    <table id="tablaReportes"  class="table table-light">
      
        <thead class="thead-light">
            <tr>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Carnet</th>
                <th>Acciones</th>
   

            </tr>
        </thead>
        <tbody>
          
      <!-- SidebarSearch Form -->
      <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" id="searchInput" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar" id="searchButton">
                <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
    </div>
    
    <div class="card-footer">
                                
                                <?= anchor('Reporte/subirpdf', 'Lista', ['class' => 'btn btn-primary']); ?>

                            </div>
</div>
      </div>
            <?php foreach ($reportes as $reporte) : ?>
                <tr>
                    <td><?php echo $reporte['apellido']; ?></td>
                    <td><?php echo $reporte['nombre']; ?></td>
                    <td><?php echo $reporte['Ci']; ?></td>

                
                    <td>
                    <a href="<?php echo 'formulariopdf/'.$reporte['Idreporte']?>" class="btn btn-success" type="button">subirPDFs</a>
                    </td>

                   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



      </div>
    </div>
  </section>

  <!-- /.content -->

  <script type="text/javascript">
    $("#menureporte").addClass("menu-open");
    $("#PDFs").addClass("active");
  </script>

  <?= $this->endSection(); ?>