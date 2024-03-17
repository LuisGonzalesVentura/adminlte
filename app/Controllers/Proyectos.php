<?php

namespace App\Controllers;

use App\Models\Proyecto;

class Proyectos extends BaseController
{
    public function vista_formulario_crear_proyecto()
    {
        $data['titulo'] = "Crear Proyecto";
        return view("proyectos/crear_proyecto", $data);
    }

    public function guardar_proyecto()
    {
        // Crear un nuevo objeto del modelo Proyecto
        $proyectoModel = new Proyecto();
    
        if ($this->request->getMethod() === 'post') {
            $nombre_proyecto = $this->request->getPost('nombre_proyecto');
            $descripcion_proyecto = $this->request->getPost('descripcion_del_proyecto');
            $fecha_inicio = $this->request->getPost('fecha_de_inicio');
            $fecha_fin = $this->request->getPost('fecha_fin');
            $oficina_proyecto = $this->request->getPost('oficinaproyecto');
            $financiador = $this->request->getPost('financiador'); // Nuevo campo
            $codigo_del_proyecto = $this->request->getPost('codigo_del_proyecto'); // Nuevo campo
    
            // Obtener el archivo PDF (documentación)
            $ruta_documentacion_pdf = $this->request->getFile('ruta_documentacion_pdf');
    
            // Inicializar $newName
            $newName = '';
    
            // Verificar si se proporcionó un archivo
            if ($ruta_documentacion_pdf->isValid() && !$ruta_documentacion_pdf->hasMoved()) {
                // Mover y obtener el nombre del archivo
                $newName = $ruta_documentacion_pdf->getRandomName();
                $ruta_documentacion_pdf->move(ROOTPATH . 'public/DocumentacionProyectos', $newName);
            }
    
            // Insertar datos en la base de datos
            $dataToInsert = [
                'nombre_proyecto' => $nombre_proyecto,
                'descripcion_proyecto' => $descripcion_proyecto,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'oficinaproyecto' => $oficina_proyecto,
                'financiador' => $financiador, // Nuevo campo
                'codigo_del_proyecto' => $codigo_del_proyecto, // Nuevo campo
                'ruta_documentacion_pdf' => $newName  // Usar el nombre del archivo o cadena vacía
            ];
    
            $proyectoModel->insert($dataToInsert);
    
            // Log the file name if it exists
            if (!empty($newName)) {
                log_message('info', 'Ruta Documentación PDF: ' . $newName);
            }
    
            // Redireccionar con mensaje de éxito
            return redirect()->to(base_url('Proyectos/vista_formulario_crear_proyecto'))->with('success_message', 'Proyecto creado exitosamente.');
        }
    
        // Redireccionar si no se recibió una solicitud POST
        return redirect()->to(base_url('Proyectos/vista_formulario_crear_proyecto'));
    }


    public function listar_proyectos()
{
    // Crear un nuevo objeto del modelo Proyecto
    $proyectoModel = new Proyecto();
    $data['titulo'] = "Lista Proyecto";
    // Obtener todos los proyectos
    $data['proyectos'] = $proyectoModel->findAll();

    // Pasar los datos a la vista de lista de proyectos
    return view('proyectos/lista_proyectos', $data);
}
    
}
