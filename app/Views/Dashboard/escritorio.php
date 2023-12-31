<?=$this->extend('Views/Dashboard/plantilla'); ?>

<?= $this->section('menu'); ?>
<!-- Sidebar Menu -->
<link rel="icon" type="image/png" href="LogoDNI.png" />

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <?php if (session()->has('rol') && session('rol') == 'admin'): ?>
            <li class="nav-item" id="menuAdministracion">
                <a href="#" class="nav-link">
                    <i class="ri-user-fill"></i>
                    <p>
                        Usuarios
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo base_url()?>/listaeditarusuarios" class="nav-link" id="menuUsuarios">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Editar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()?>/crearusuario" class="nav-link" id="crearUsuarios">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Crear</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()?>/listaborrarusuarios" class="nav-link" id="eliminarUsuarios">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Eliminar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()?>/listadesactivarusuarios" class="nav-link" id="desactivarUsuarios">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Desactivar</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <li class="nav-item" id="menureporte">
            <a href="#" class="nav-link">
                <i class="ri-folder-chart-2-fill"></i>
                <p>
                    Reporte
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/index"); ?>" class="nav-link" id="reportelista">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/vista_formulario_crear_reporte"); ?>" class="nav-link" id="crearreporte">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Crear Reporte </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/editar_reporte"); ?>" class="nav-link" id="editar_reporte">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Editar Reporte</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/subirpdf"); ?>" class="nav-link" id="PDFs">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Subir PDFs</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" onclick="cerrarSesion();" class ="nav-link">
                <i class="fas fa-sign-out-alt text-danger"></i>
                <p>Salir</p>
            </a>
        </li>
    </ul>
</nav>

<script type="text/javascript">
    function cerrarSesion() {
        swal.fire({
            title: '¿Desea salir?',
            text: 'La sesión terminará.',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Salir'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('Login/cerrarSesion');?>";
            }
        });
    }
</script>

<!-- /.sidebar-menu -->
<?=$this->endSection(); ?>

<?=$this->section('folder'); ?>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2023 <a href="https://www.dni-bolivia.org.bo/">DNI-Bolivia.org</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<?=$this->endSection(); ?>
