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


        <li class="nav-item" id="menuoficinas">
            <a href="#" class="nav-link">
            <i class="ri-building-2-fill"></i>
                                           Oficinas DNI
                    <i class="right fas fa-angle-left"></i>
                    
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url("oficinas/vista_oficinas_filial_crear"); ?>" class="nav-link" id="crear_filial">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Añadir oficina</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("oficinas/listarOficinas"); ?>" class="nav-link" id="listaoficina">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista de oficinas</p>
                    </a>
                </li>
               
            </ul>
        </li>

        
        <li class="nav-item" id="menucontratos">
            <a href="#" class="nav-link">
            <i class="ri-file-2-fill"></i>
                                          Tipos Contratos
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url("tipocontratos/vista_Contrato_crear"); ?>" class="nav-link" id="crear_contrato">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Añadir Tipo de contratos</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("tipocontratos/listar_contratos"); ?>" class="nav-link" id="lista_ccontratos">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista de contratos</p>
                    </a>
                </li>
               
            </ul>
        </li>
        
        <li class="nav-item" id="menucontratospdff">
            <a href="#" class="nav-link">
            <i class="ri-article-fill"></i>                                        
            Contratos
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url("contrato/vista_Contrato_subir_pdf_formulario"); ?>" class="nav-link" id="crear_contratos"style="color: orange;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Añadir contrato trabajador en planillas</p>
                    </a>
                    <li class="nav-item">
                    <a href="<?php echo base_url("contrato/listarContratos"); ?>" class="nav-link" id="lista_ccontratosss"style="color: orange;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista de contratos</p>
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("contrato_consultor_nn/vista_Contrato_subir_pdf_formulario"); ?>" class="nav-link" id="crear_contratos_consultoria_n" style="color: salmon;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Añadir contrato consultor natural</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("contrato_consultor_nn/listarContratosConsultores"); ?>" class="nav-link" id="lista_ccontratosss_consultor" style="color: salmon;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista de contratos</p>
                    </a>
                </li>
               
            </ul>
        </li>

        
        <li class="nav-item" id="menufiniquito">
            <a href="#" class="nav-link">
            <i class="ri-file-copy-2-fill"></i>
                        finiquito
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url("finiquito/vista_finiquito_subir_pdf_formulario"); ?>" class="nav-link" id="finiquito_subir">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Añadir finiquito al trabajador</p>
                    </a>

                </li>
                <li class="nav-item">
    <a href="<?php echo base_url("finiquito/listar_finiquitos"); ?>" class="nav-link" id="lista_finiquito">
        <i class="far fa-circle nav-icon"></i>
        <p>Lista de finiquitos</p>
    </a>
</li>

               
            </ul>
        </li>



        <li class="nav-item" id="menureporte">
            <a href="#" class="nav-link">
            <i class="ri-team-fill"></i>                <p>
            Recurso humano
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/index"); ?>" class="nav-link" id="reportelista" style="color: orange;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista en Planillas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/vista_formulario_crear_reporte"); ?>" class="nav-link" id="crearreporte"style="color: orange;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Crear en Planillas </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/subirpdf"); ?>" class="nav-link" id="PDFs"style="color: orange;">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Subir PDF en Planillas </p>
                    </a>
                </li>
                <li class="nav-item">
    <a href="<?php echo base_url("consultores/listarConsultores_n"); ?>" class="nav-link" id="listaconultor" style="color: salmon;">
        <i class="far fa-circle nav-icon"></i>
        <p> Lista consultor natural</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo base_url("consultores/vista_formulario_crear_consultores_natural"); ?>" class="nav-link" id="vista_formulario_crear_consultores_natural" style="color: salmon;">
        <i class="far fa-circle nav-icon"></i>
        <p> Crear consultor natural</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo base_url("consultores/lista_vista_formulario_subir_pdf_consultores"); ?>" class="nav-link" id="vista_formulario_crear_consultores_naturals" style="color: salmon;">
        <i class="far fa-circle nav-icon"></i>
        <p> Subir PDF Consultor N</p>
    </a>
</li>


                
            </ul>
        </li>
        <li class="nav-item" id="menuproyecto">
            <a href="#" class="nav-link">
            <i class="ri-briefcase-4-fill"></i>
                                Proyectos 
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url("Proyectos/listar_proyectos"); ?>" class="nav-link" id="listapryectos">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista Proyectos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("Proyectos/vista_formulario_crear_proyecto"); ?>" class="nav-link" id="crearproyecto">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Crear Proyecto</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/editar_reporte"); ?>" class="nav-link" id="editar_reporte">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Editar proyectos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("Reporte/subirpdf"); ?>" class="nav-link" id="PDFs">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Añadir Personal</p>
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
