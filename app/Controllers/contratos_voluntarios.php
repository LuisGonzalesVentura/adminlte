<?php

namespace App\Controllers;

use App\Models\ContratoModel; // Corregir el modelo a utilizar
use App\Models\TipoContrato;
use App\Models\Usuario; // Importar el modelo de Usuario
use App\Models\registroconsultoria_n;
use App\Models\contrato_voluntario;
use App\Models\consultoria_persona_juridica_model;
use App\Models\VoluntarioModel;


class contratos_voluntarios extends BaseController
{

    public function vista_Contrato_subir_pdf_formulario_v()
{
    // Obtener los tipos de contrato desde el modelo
    $tipoContratoModel = new TipoContrato();
    $data['tipos_contrato'] = $tipoContratoModel->findAll();

    // Obtener los voluntarios desde el modelo
    $voluntarioModel = new VoluntarioModel();
    $data['voluntarios'] = $voluntarioModel->findAll();

    // Cargar la vista con los tipos de contrato y los voluntarios
    $data['titulo'] = "Subir contrato de voluntario";

    return view("contratos_voluntarios/formulario_subir_contrato_voluntario", $data);
} 
// En el controlador ContratosVoluntarios
public function crearContratoVoluntario()
{
    // Verificar si se están enviando datos del formulario
    if ($this->request->getMethod() === 'post') {
        // Recibir los datos del formulario
        $Voluntario_id = $this->request->getPost('Voluntario_id');
        $tipo_contrato_voluntario = $this->request->getPost('tipo_contrato_voluntario');
        $fecha_inicio_contrato_voluntario = $this->request->getPost('fecha_inicio_contrato_voluntario');
        $fecha_finalizacion_contrato_voluntario = $this->request->getPost('fecha_finalizacion_contrato_voluntario');

        // Verificar si se ha seleccionado un voluntario
        if (empty($Voluntario_id)) {
            // Mostrar un mensaje de error o redirigir a una página de error
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'Por favor, selecciona un voluntario.');
        }

        // Obtener el voluntario para generar el nombre del archivo
        $voluntarioModel = new VoluntarioModel();
        $voluntario = $voluntarioModel->find($Voluntario_id);

        // Verificar si se encontró el voluntario
        if (!$voluntario) {
            // Manejar el caso en el que el voluntario no se encuentre
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'El voluntario no se encontró.');
        } else {
            // Obtener el CI del voluntario
            $CI_voluntario = $voluntario->carnet_identidad_v; // Asumiendo que el CI del voluntario se encuentra en el campo 'CI' en la tabla de voluntarios

            // Generar el nombre del archivo PDF
            $nuevo_nombre_archivo = $CI_voluntario . '_' . date('Y-m-d_H-i-s') . '.pdf';
        }

        // Verificar si se ha enviado un archivo
        $archivo_pdf = $this->request->getFile('archivo_v');
        if ($archivo_pdf && $archivo_pdf->isValid() && !$archivo_pdf->hasMoved()) {
            // Ruta de destino para guardar los archivos PDF de contratos
            $ruta_destino = FCPATH . 'pdfscontratos' . DIRECTORY_SEPARATOR;

            // Mover el archivo al directorio de destino
            try {
                $archivo_pdf->move($ruta_destino, $nuevo_nombre_archivo);
            } catch (\Exception $e) {
                // Manejar el error si falla la transferencia del archivo
                return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'Error al subir el archivo PDF: ' . $e->getMessage());
            }
        } else {
            // Si no se ha enviado un archivo, muestra un mensaje de error o maneja la situación según sea necesario
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'No se ha enviado ningún archivo PDF.');
        }

        // Guardar los datos del contrato en la base de datos
        $contratoVoluntarioModel = new contrato_voluntario();
        $data = [
            'Voluntario_id' => $Voluntario_id,
            'archivo_v' => $nuevo_nombre_archivo,
            'tipo_contrato_voluntario' => $tipo_contrato_voluntario,
            'fecha_inicio_contrato_voluntario' => $fecha_inicio_contrato_voluntario,
            'fecha_finalizacion_contrato_voluntario' => $fecha_finalizacion_contrato_voluntario,
            'usuario_creator_voluntario' => session()->get('Idusuario'), // Obtener el ID del usuario actual de tu sesión
            'fecha_creacion_voluntario' => date('Y-m-d'),
            'fecha_modificacion_voluntario' => date('Y-m-d') // Establecer la fecha de modificación (si es necesario)
        ];

        try {
            $contratoVoluntarioModel->insert($data);
            // Redirigir a una página de éxito o mostrar un mensaje de éxito
            return redirect()->to(base_url('contratos_voluntarios/vista_Contrato_subir_pdf_formulario_v'))->with('success_message', 'Contrato de voluntario creado con éxito.');
        } catch (\Exception $e) {
            // Mostrar el mensaje de error o redirigir a una página de error
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'Error al crear el contrato de voluntario: ' . $e->getMessage());
        }
    }

    // Si no hay datos del formulario, redirigir a alguna página
    return redirect()->to(base_url('ruta_por_defecto'));
}
public function listarContratosVoluntarios()
{
    // Obtener todos los contratos de voluntarios desde el modelo
    $contratoVoluntarioModel = new contrato_voluntario();
    $contratosVoluntarios = $contratoVoluntarioModel->findAll();

    // Crear un nuevo modelo para obtener información adicional sobre los voluntarios
    $voluntarioModel = new VoluntarioModel();

    // Iterar sobre cada contrato de voluntario
    foreach ($contratosVoluntarios as &$contratoVoluntario) {
        // Obtener los detalles del voluntario correspondiente al ID de voluntario
        $voluntario = $voluntarioModel->find($contratoVoluntario->Voluntario_id); // Acceder al ID como una propiedad de objeto

        // Si se encuentra el voluntario, asignar su nombre completo y su CI al contrato
        if ($voluntario) {
            // Obtener el nombre completo del voluntario
            $nombreCompleto = $voluntario->nombres_v;
            $contratoVoluntario->nombre_voluntario = $nombreCompleto; // Asignar el nombre completo como propiedad del objeto
            
            // Obtener el CI del voluntario
            $ciVoluntario = $voluntario->carnet_identidad_v;
            $contratoVoluntario->ci_voluntario = $ciVoluntario; // Asignar el CI como propiedad del objeto
        } else {
            // Si no se encuentra el voluntario, asignar valores por defecto
            $contratoVoluntario->nombre_voluntario = 'Desconocido';
            $contratoVoluntario->ci_voluntario = 'N/A';
        }
    }
    unset($contratoVoluntario);

    // Pasar los datos actualizados a la vista
    $data['contratos_voluntarios'] = $contratosVoluntarios;
    $data['titulo'] = "Listado de contratos de voluntarios";

    // Cargar la vista para mostrar los contratos de voluntarios
    return view("contratos_voluntarios/lista_contratos_voluntarios", $data);
}

public function vista_formulario_edicion_contrato_voluntario($idContrato)
{
    // Cargar el modelo de Contrato Voluntario
    $contratoVoluntarioModel = new contrato_voluntario();

    // Obtener la información del contrato por su ID
    $contratoVoluntario = $contratoVoluntarioModel->find($idContrato);

    // Verificar si el contrato existe
    if (!$contratoVoluntario) {
        // Redirigir a una página de error si el contrato no existe
        return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Contrato no encontrado');
    }

    // Pasar la información del contrato a la vista
    $data['titulo'] = "Edición de contrato voluntario";
    $data['contrato_voluntario'] = $contratoVoluntario;

    // Cargar la vista con los datos del contrato para editar
    return view("contratos_voluntarios/formulario_edicion_voluntarios", $data);
}
public function editarContratoVoluntario($idContrato)
{
    // Verificar si se están enviando datos del formulario
    if ($this->request->getMethod() === 'post') {
        // Recibir los datos del formulario
        $fecha_de_inicio = $this->request->getPost('fecha_de_inicio');
        $fecha_de_finalizacion = $this->request->getPost('fecha_de_finalizacion');
        $nuevo_archivo = $this->request->getFile('nuevo_archivo');

        // Cargar el modelo de Contrato Voluntario
        $contratoVoluntarioModel = new Contrato_voluntario();

        // Obtener la información del contrato voluntario por su ID
        $contratoVoluntario = $contratoVoluntarioModel->find($idContrato);

        // Verificar si el contrato voluntario existe
        if (!$contratoVoluntario) {
            return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Contrato no encontrado');
        }

        // Verificar si se ha cargado un nuevo archivo y moverlo si es necesario
        if ($nuevo_archivo->isValid() && !$nuevo_archivo->hasMoved()) {
            // Verificar si se encontró el ID del voluntario en el contrato
            if (empty($contratoVoluntario->Voluntario_id)) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'ID de voluntario no encontrado en el contrato');
            }

            // Obtener el voluntario asociado al contrato
            $voluntarioModel = new VoluntarioModel();
            $voluntario = $voluntarioModel->find($contratoVoluntario->Voluntario_id);

            // Verificar si se encontró el voluntario
            if (!$voluntario) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Voluntario no encontrado');
            }

            // Generar el nombre del nuevo archivo
            $nuevo_nombre_archivo = $voluntario->carnet_identidad_v . '_' . date('Y-m-d_H-i-s') . '.pdf';

            // Ruta de destino para guardar los archivos PDF de contratos
            $ruta_destino = FCPATH . 'pdfscontratos' . DIRECTORY_SEPARATOR;

            // Mover el archivo al directorio de destino
            try {
                $nuevo_archivo->move($ruta_destino, $nuevo_nombre_archivo);
            } catch (\Exception $e) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al subir el archivo PDF: ' . $e->getMessage());
            }
        } else {
            // Si no se cargó un nuevo archivo, mantener el nombre del archivo actual
            $nuevo_nombre_archivo = $contratoVoluntario->archivo_v;
        }

        // Actualizar los datos del contrato en la base de datos
        $data['fecha_inicio_contrato_voluntario'] = $fecha_de_inicio ?? $contratoVoluntario->fecha_inicio_contrato_voluntario;
        $data['fecha_finalizacion_contrato_voluntario'] = $fecha_de_finalizacion ?? $contratoVoluntario->fecha_finalizacion_contrato_voluntario;
        $data['archivo_v'] = $nuevo_nombre_archivo;
        $data['fecha_modificacion_voluntario'] = date('Y-m-d H:i:s');

        try {
            $contratoVoluntarioModel->update($idContrato, $data);
            return redirect()->to(base_url('contratos_voluntarios/vista_formulario_edicion_contrato_voluntario/' . $idContrato))->with('success_message', 'Cambios guardados con éxito.');
        } catch (\Exception $e) {
            return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al actualizar el contrato: ' . $e->getMessage());
        }
    }

    // Si no se enviaron datos del formulario, redirigir a alguna página
    return redirect()->to(base_url('ruta_por_defecto'));
}

}