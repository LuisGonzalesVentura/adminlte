<?php

namespace App\Controllers;

use App\Models\ContratoModel; // Corregir el modelo a utilizar
use App\Models\TipoContrato;
use App\Models\Usuario; // Importar el modelo de Usuario
use App\Models\Reportes;
use App\Models\finiquito_model;



class finiquito extends BaseController
{
    
    public function vista_finiquito_subir_pdf_formulario()
    {
        // Obtener los empleados desde el modelo de Reporte_model
        $reporteModel = new Reportes();
        $data['empleados'] = $reporteModel->findAll();
    
        // Cargar la vista con los empleados
        $data['titulo'] = "Subir finiquito";
        return view("finiquitos/crear_finiquito", $data);
    }
    
    public function crear_finiquito()
    {
        // Verificar si se están enviando datos del formulario
        if ($this->request->getMethod() === 'post') {
            // Recibir los datos del formulario
            $id_empleado = $this->request->getPost('id_empleado_c');
            $fecha_finiquito = $this->request->getPost('fecha_de_inicio');
            $archivo_pdf = $this->request->getFile('ruta_documentacion_pdf');
    
            // Obtener el CI del empleado
            $reporteModel = new Reportes();
            $empleado = $reporteModel->find($id_empleado);
            $ci_empleado = $empleado->Ci;
    
            // Generar el nombre del archivo PDF
            $nuevoNombreArchivo = $ci_empleado . '_' . date_format(date_create($fecha_finiquito), 'Ymd') . '.pdf';
    
            // Ruta de destino para guardar los archivos PDF de finiquitos
            $ruta_destino = FCPATH . 'pdfsfiniquitos' . DIRECTORY_SEPARATOR;
    
            // Mover el archivo al directorio de destino
            try {
                $archivo_pdf->move($ruta_destino, $nuevoNombreArchivo);
            } catch (\Exception $e) {
                // Manejar el error si falla la transferencia del archivo
                echo 'Error al mover el archivo: ' . $e->getMessage();
                die();  // Detener la ejecución para ver el mensaje de error
            }
    
            // Ahora que el archivo está en la ubicación deseada, puedes guardar los datos en la base de datos
            $finiquitoModel = new finiquito_model();
    
            // Configurar los datos a insertar
            $data_finiquito = [
                'id_empleado_f' => $id_empleado,
                'archivo_f' => $nuevoNombreArchivo,
                'usuario_creador_f' => session()->get('Idusuario'), // Obtener el ID del usuario actual de tu sesión
                'fecha_de_finiquito_f' => $fecha_finiquito,
                'fecha_modificacion_finiquito_f' => '0000-00-00' // Establecer la fecha de modificación en '0000-00-00'
            ];
    
            // Intentar insertar los datos y capturar cualquier error que ocurra
            try {
                $finiquitoModel->insert($data_finiquito);
    
                // Redirigir a una página de éxito o mostrar un mensaje de éxito
                session()->setFlashdata('success_message', 'Finiquito creado con éxito');
                return redirect()->to(base_url('finiquito/vista_finiquito_subir_pdf_formulario'));
            } catch (\Exception $e) {
                // Mostrar el mensaje de error o redirigir a una página de error
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al crear el finiquito: ' . $e->getMessage());
            }
        }
    
        // Si no hay datos del formulario, redirigir a alguna página
        return redirect()->to('ruta_por_defecto');
    }
    
    
/// FiniquitoController.php

public function listar_finiquitos()
{
    $finiquitoModel = new Finiquito_model();
    $reportesModel = new Reportes();
    $usuarioModel = new Usuario();

    // Obtener todos los finiquitos
    $data['finiquitos'] = $finiquitoModel->findAll();

    // Iterar sobre los finiquitos y obtener información del empleado y usuario creador
    foreach ($data['finiquitos'] as &$finiquito) {
        $empleado = $reportesModel->find($finiquito['id_empleado_f']);
        
        // Verificar si se encontró el empleado
        if ($empleado) {
            $finiquito['nombre_empleado'] = $empleado->nombre . ' ' . $empleado->apellido;
            $finiquito['carnet_empleado'] = $empleado->Ci;
        } else {
            $finiquito['nombre_empleado'] = 'Empleado no encontrado';
            $finiquito['carnet_empleado'] = 'N/A';
        }
        
        // Obtener información del usuario creador
        $usuarioCreador = $usuarioModel
            ->select('nombre, apellido')
            ->find($finiquito['usuario_creador_f']);

        // Verificar si se encontró el usuario creador
        if ($usuarioCreador) {
            $finiquito['nombre_usuario'] = $usuarioCreador['nombre'];
            $finiquito['apellido_usuario'] = $usuarioCreador['apellido'];
        } else {
            $finiquito['nombre_usuario'] = 'Usuario no encontrado';
            $finiquito['apellido_usuario'] = '';
        }
    }

    return view('finiquitos/lista_finiquitos', $data);
}


public function vista_formulario_edicion_finiquito($idFiniquito)
{
    $finiquitoModel = new Finiquito_model();
    $reportesModel = new Reportes();

    // Obtener el finiquito por ID
    $data['finiquito'] = $finiquitoModel->find($idFiniquito);

    // Verificar si el finiquito existe
    if (!$data['finiquito']) {
        // Puedes manejar el caso en el que el finiquito no exista, por ejemplo, redirigiendo a una página de error
        return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Finiquito no encontrado');
    }

    // Obtener la lista de empleados
    $data['empleados'] = $reportesModel->findAll();

    // Cargar la vista con los datos del finiquito y la lista de empleados
    return view('finiquitos/formulario_editar', $data);
}



public function guardar_edicion_finiquito($idFiniquito)
{
    // Verificar si se están enviando datos del formulario
    if ($this->request->getMethod() === 'post') {
        // Recibir los datos del formulario
        $fechaFiniquito = $this->request->getPost('fecha_de_inicio');
        $nuevoArchivo = $this->request->getFile('nuevo_archivo');

        // Obtener el finiquito por su ID
        $finiquitoModel = new Finiquito_model();
        $finiquito = $finiquitoModel->find($idFiniquito);

        // Verificar si el finiquito existe
        if (!$finiquito) {
            throw new \RuntimeException('Finiquito no encontrado');
            // O redirigir a una página de error con mensaje
            // return redirect()->to('ruta_de_error')->with('error_message', 'Finiquito no encontrado');
        }

        // Si se proporciona un nuevo archivo, generar el nuevo nombre del archivo
        $nuevoNombreArchivo = '';
        if ($nuevoArchivo && $nuevoArchivo->isValid() && !$nuevoArchivo->hasMoved()) {
            // Obtener el CI del empleado asociado al finiquito
            $reportesModel = new Reportes();
            $empleado = $reportesModel->find($finiquito['id_empleado_f']);
            $carnetEmpleado = $empleado ? $empleado->Ci : '';

            $nuevoNombreArchivo = $carnetEmpleado . '_' . date('YmdHis') . '.pdf';

            // Ruta de destino para guardar los archivos PDF de finiquitos
            $rutaDestino = FCPATH . 'pdfsfiniquitos' . DIRECTORY_SEPARATOR;

            // Mover el nuevo archivo al directorio de destino
            try {
                $nuevoArchivo->move($rutaDestino, $nuevoNombreArchivo);
            } catch (\Exception $e) {
                throw new \RuntimeException('Error al mover el archivo: ' . $e->getMessage());
                // O redirigir a una página de error con mensaje
                // return redirect()->to('ruta_de_error')->with('error_message', 'Error al mover el archivo: ' . $e->getMessage());
            }
        }

        // Actualizar los datos en la base de datos
        $data = [
            'fecha_de_finiquito_f' => $fechaFiniquito,
            'archivo_f' => $nuevoNombreArchivo ? $nuevoNombreArchivo : $finiquito['archivo_f'],
            // Puedes agregar más campos a actualizar si es necesario
        ];

        try {
            // Utilizar el método update para actualizar el registro
            $finiquitoModel->update($idFiniquito, $data);

            // Redirigir a una página de éxito o mostrar un mensaje de éxito
            return redirect()->to('finiquito/listar_finiquitos')->with('success_message', 'Finiquito actualizado con éxito');
        } catch (\Exception $e) {
            throw new \RuntimeException('Error al actualizar el finiquito: ' . $e->getMessage());
            // O redirigir a una página de error con mensaje
            // return redirect()->to('ruta_de_error')->with('error_message', 'Error al actualizar el finiquito: ' . $e->getMessage());
        }
    }

    // Si no hay datos del formulario, redirigir a alguna página
    return redirect()->to('ruta_por_defecto');
}



}