<?php

namespace App\Controllers;

use App\Models\ContratoModel; // Corregir el modelo a utilizar
use App\Models\TipoContrato;
use App\Models\Usuario; // Importar el modelo de Usuario
use App\Models\registroconsultoria_n;
use App\Models\contrato_consultor_n;


class contrato_consultor_nn extends BaseController
{

    public function vista_Contrato_subir_pdf_formulario()
{
    // Obtener los tipos de contrato desde el modelo
    $tipoContratoModel = new TipoContrato();
    $data['tipos_contrato'] = $tipoContratoModel->findAll();

    // Obtener los empleados de consultoría desde el modelo
    $registroconsultoriaModel = new registroconsultoria_n();
    $data['empleados_consultoria'] = $registroconsultoriaModel->findAll();

    // Cargar la vista con los tipos de contrato y los empleados de consultoría
    $data['titulo'] = "Subir contrato";
    return view("contratos_consultor_n/formulario_subir_consultor_n", $data);
}

public function crearContratoConsultoria()
{
    // Verificar si se están enviando datos del formulario
    if ($this->request->getMethod() === 'post') {
        // Recibir los datos del formulario
        $id_consultor = $this->request->getPost('id_consultor');
        $tipo_contrato = $this->request->getPost('tipo_contrato');
        $fecha_de_inicio = $this->request->getPost('fecha_de_inicio');
        $fecha_de_finalizacion = $this->request->getPost('fecha_de_finalizacion');
        $archivo_pdf = $this->request->getFile('ruta_documentacion_pdf');

        // Verificar si se ha seleccionado un consultor
        if (empty($id_consultor)) {
            // Mostrar un mensaje de error o redirigir a una página de error
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'Por favor, selecciona un consultor.');
        }

        // Suponiendo que $id_consultor es el ID del consultor
$registroconsultoriaModel = new registroconsultoria_n();
$consultor = $registroconsultoriaModel->find($id_consultor);

// Verificar si se encontró el consultor
if (!$consultor) {
    // Manejar el caso en el que el consultor no se encuentre
} else {
    // Obtener el CI del consultor
$carnet_identidad_n = $consultor->carnet_identidad_n;

// Usar el CI para generar el nombre del archivo
$nuevo_nombre_archivo = $carnet_identidad_n . '_' . date('Y-m-d_H-i-s') . '.pdf';
}

        // Ruta de destino para guardar los archivos PDF de contratos
        $ruta_destino = FCPATH . 'pdfscontratos' . DIRECTORY_SEPARATOR;

        // Mover el archivo al directorio de destino
        try {
            $archivo_pdf->move($ruta_destino, $nuevo_nombre_archivo);
        } catch (\Exception $e) {
            // Manejar el error si falla la transferencia del archivo
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'Error al subir el archivo PDF: ' . $e->getMessage());
        }

        // Guardar los datos del contrato en la base de datos
        $contratoModel = new contrato_consultor_n();
        $data = [
            'id_empleado_c_n' => $id_consultor,
            'archivo_c_n' => $nuevo_nombre_archivo,
            'tipo_contrato_c_n' => $tipo_contrato,
            'fecha_inicio_contrato_c_n' => $fecha_de_inicio,
            'fecha_finalizacion_contrato_c_n' => $fecha_de_finalizacion,
            'usuario_creator_c_n' => session()->get('Idusuario'), // Obtener el ID del usuario actual de tu sesión
            'fecha_creacion_c_n' => date('Y-m-d'),
            'fecha_modificacion_c_n' => '0000-00-00' // Establecer la fecha de modificación (si es necesario)
        ];

        try {
            $contratoModel->insert($data);
            // Redirigir a una página de éxito o mostrar un mensaje de éxito
            return redirect()->to(base_url('contrato_consultor_nn/vista_Contrato_subir_pdf_formulario'))->with('success_message', 'Contrato creado con éxito.');
        
        } catch (\Exception $e) {
            // Mostrar el mensaje de error o redirigir a una página de error
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'Error al crear el contrato: ' . $e->getMessage());
        }
    }

    // Si no hay datos del formulario, redirigir a alguna página
    return redirect()->to(base_url('ruta_por_defecto'));
}

public function listarContratosConsultores()
{// Obtener todos los contratos de consultores desde el modelo
    $contratoConsultorModel = new contrato_consultor_n();
    $contratosConsultores = $contratoConsultorModel
        ->findAll(); // Obtener todos los contratos consultores
    
    // Crear un nuevo modelo de registro de consultoría para obtener información adicional
    $registroConsultoriaModel = new registroconsultoria_n();

    // Iterar sobre cada contrato de consultor
    foreach ($contratosConsultores as &$contratoConsultor) {
        // Obtener los detalles del consultor correspondiente al ID de consultor
        $consultor = $registroConsultoriaModel->find($contratoConsultor['id_empleado_c_n']); // Acceder al ID como un array

        // Si se encuentra el consultor, asignar su nombre completo al contrato
        if ($consultor) {
            $nombreCompleto = $consultor->apellido_paterno_n . ' ' . $consultor->apellido_materno_n . ' ' . $consultor->nombres_n;
            $contratoConsultor['nombre_consultor'] = $nombreCompleto; // Acceder al nombre como un array

            // Agregar el CI del consultor a los datos del contrato
            $contratoConsultor['ci_consultor'] = $consultor->carnet_identidad_n; // Acceder al CI como un array
        } else {
            $contratoConsultor['nombre_consultor'] = 'Desconocido';
            $contratoConsultor['ci_consultor'] = 'N/A';
        }
    }
    unset($contratoConsultor);

    // Pasar los datos actualizados a la vista
    $data['contratos_consultores'] = $contratosConsultores;
    $data['titulo'] = "Listado de contratos de consultores";

    // Cargar la vista para mostrar los contratos de consultores
    return view("contratos_consultor_n/lista_contratos_consultores_n", $data);
}


public function vista_formulario_edicion_contrato($idContrato)
{
    // Cargar el modelo de Contrato de Consultoría
    $contratoConsultorModel = new contrato_consultor_n();

    // Obtener la información del contrato por su ID
    $contratoConsultor = $contratoConsultorModel->find($idContrato);

    // Verificar si el contrato existe
    if (!$contratoConsultor) {
        // Puedes manejar el caso en el que el contrato no exista, por ejemplo, redirigiendo a una página de error
        return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Contrato no encontrado');
    }

    // Pasar la información del contrato a la vista
    $data['titulo'] = "Edición de contrato de consultoría";
    $data['contrato_consultor'] = $contratoConsultor;

    // Cargar la vista con los datos del contrato
    return view("contratos_consultor_n/formulario_edicion_contrato_consultor_n", $data);
}
public function editarContratoConsultoria($idContrato)
{
    // Verificar si se están enviando datos del formulario
    if ($this->request->getMethod() === 'post') {
        // Recibir los datos del formulario
        $fecha_de_inicio = $this->request->getPost('fecha_de_inicio');
        $fecha_de_finalizacion = $this->request->getPost('fecha_de_finalizacion');
        $nuevo_archivo = $this->request->getFile('nuevo_archivo');

        // Cargar el modelo de Contrato Consultor
        $contratoConsultorModel = new Contrato_consultor_n();

        // Obtener la información del contrato consultor por su ID
        $contratoConsultoria = $contratoConsultorModel->find($idContrato);

        // Verificar si el contrato consultor existe
        if (!$contratoConsultoria) {
            return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Contrato no encontrado');
        }

        // Verificar si se ha cargado un nuevo archivo
        if ($nuevo_archivo->isValid() && !$nuevo_archivo->hasMoved()) {
            // Verificar si se encontró el ID del consultor en el contrato
            if (empty($contratoConsultoria['id_empleado_c_n'])) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'ID de consultor no encontrado en el contrato');
            }

            // Obtener el consultor asociado al contrato
            $registroconsultoriaModel = new Registroconsultoria_n();
            $consultor = $registroconsultoriaModel->find($contratoConsultoria['id_empleado_c_n']);

            // Verificar si se encontró el consultor
            if (!$consultor) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Consultor no encontrado');
            }

            // Generar el nombre del nuevo archivo
            $nuevo_nombre_archivo = $consultor->carnet_identidad_n . '_' . date('Y-m-d_H-i-s') . '.pdf';

            // Ruta de destino para guardar los archivos PDF de contratos
            $ruta_destino = FCPATH . 'pdfscontratos' . DIRECTORY_SEPARATOR;

            // Mover el archivo al directorio de destino
            try {
                $nuevo_archivo->move($ruta_destino, $nuevo_nombre_archivo);
            } catch (\Exception $e) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al subir el archivo PDF: ' . $e->getMessage());
            }

            // Actualizar los datos del contrato en la base de datos
            $data = [
                'fecha_inicio_contrato_c_n' => $fecha_de_inicio,
                'fecha_finalizacion_contrato_c_n' => $fecha_de_finalizacion,
                'archivo_c_n' => $nuevo_nombre_archivo,
                'fecha_modificacion_c_n' => date('Y-m-d H:i:s') // Agregar la fecha de modificación actual
            ];

            try {
                $contratoConsultorModel->update($idContrato, $data);
                return redirect()->to(base_url('contrato_consultor_nn/vista_formulario_edicion_contrato/' . $idContrato))->with('success_message', 'Cambios guardados con éxito.');
            } catch (\Exception $e) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al actualizar el contrato: ' . $e->getMessage());
            }
        }
    }

    // Si no se enviaron datos del formulario, redirigir a alguna página
    return redirect()->to(base_url('ruta_por_defecto'));
}



}