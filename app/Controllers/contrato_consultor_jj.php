<?php

namespace App\Controllers;

use App\Models\ContratoModel; 
use App\Models\TipoContrato;
use App\Models\Usuario; 
use App\Models\registroconsultoria_n;
use App\Models\contrato_consultor_juridico;
use App\Models\consultoria_persona_juridica_model;


class contrato_consultor_jj extends BaseController
{

    public function vista_Contrato_subir_pdf_formulario_j()
{
    // Obtener los tipos de contrato desde el modelo
    $tipoContratoModel = new TipoContrato();
    $data['tipos_contrato'] = $tipoContratoModel->findAll();

    // Obtener los empleados de consultoría desde el modelo
    $registroconsultoriaModel = new consultoria_persona_juridica_model();
    $data['empleados_consultoria'] = $registroconsultoriaModel->findAll();

    // Cargar la vista con los tipos de contrato y los empleados de consultoría
    $data['titulo'] = "Subir contrato juridico";

    return view("contratos_consultore_j/formulario_subir_consultor_j", $data);
}

public function crearContratoConsultoria()
{
    // Verificar si se están enviando datos del formulario
    if ($this->request->getMethod() === 'post') {
        // Recibir los datos del formulario
        $id_consultor = $this->request->getPost('id_consultor'); // Corregido el nombre del campo
        $tipo_contrato = $this->request->getPost('tipo_contrato_c_j');
        $fecha_de_inicio = $this->request->getPost('fecha_inicio_contrato_c_j');
        $fecha_de_finalizacion = $this->request->getPost('fecha_finalizacion_contrato_c_j');

        // Verificar si se ha seleccionado un consultor
        if (empty($id_consultor)) {
            // Mostrar un mensaje de error o redirigir a una página de error
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'Por favor, selecciona un consultor.');
        }

        // Obtener el consultor para generar el nombre del archivo
        $registroconsultoriaModel = new consultoria_persona_juridica_model();
        $consultor = $registroconsultoriaModel->find($id_consultor);

        // Verificar si se encontró el consultor
        if (!$consultor) {
            // Manejar el caso en el que el consultor no se encuentre
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'El consultor no se encontró.');
        } else {
            // Obtener el NITEmpresa_c_p del consultor
            $NITEmpresa_c_p = $consultor->NITEmpresa_c_p;

            // Generar el nombre del archivo PDF
            $nuevo_nombre_archivo = $NITEmpresa_c_p . '_' . date('Y-m-d_H-i-s') . '.pdf';
        }

       // Verificar si se ha enviado un archivo
$archivo_pdf = $this->request->getFile('archivo_c_j');
if ($archivo_pdf && $archivo_pdf->isValid() && !$archivo_pdf->hasMoved()) {
    // Recibir el archivo del formulario

    // Generar el nombre del archivo PDF
    $nuevo_nombre_archivo = $NITEmpresa_c_p . '_' . date('Y-m-d_H-i-s') . '.pdf';

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
        $contratoModel = new contrato_consultor_juridico();
        $data = [
            'empleado_c_j' => $id_consultor,
            'archivo_c_j' => $nuevo_nombre_archivo,
            'tipo_contrato_c_j' => $tipo_contrato,
            'fecha_inicio_contrato_c_j' => $fecha_de_inicio,
            'fecha_finalizacion_contrato_c_j' => $fecha_de_finalizacion,
            'usuario_creator_c_j' => session()->get('Idusuario'), // Obtener el ID del usuario actual de tu sesión
            'fecha_creacion_c_j' => date('Y-m-d'),
            'fecha_modificacion_c_j' => '0000-00-00' // Establecer la fecha de modificación (si es necesario)
        ];

        try {
            $contratoModel->insert($data);
            // Redirigir a una página de éxito o mostrar un mensaje de éxito
            return redirect()->to(base_url('contrato_consultor_jj/vista_Contrato_subir_pdf_formulario_j'))->with('success_message', 'Contrato creado con éxito.');
        } catch (\Exception $e) {
            // Mostrar el mensaje de error o redirigir a una página de error
            return redirect()->to(base_url('ruta_de_la_pagina_de_error'))->with('error_message', 'Error al crear el contrato: ' . $e->getMessage());
        }
    }

    // Si no hay datos del formulario, redirigir a alguna página
    return redirect()->to(base_url('ruta_por_defecto'));
}



public function listarContratosConsultoresJuridicos()
{
    // Obtener todos los contratos de consultores jurídicos desde el modelo
    $contratoConsultorModel = new contrato_consultor_juridico();
    $contratosConsultores = $contratoConsultorModel->findAll();

    // Crear un nuevo modelo de consultoría para obtener información adicional
    $registroConsultoriaModel = new consultoria_persona_juridica_model();

    // Iterar sobre cada contrato de consultor jurídico
    foreach ($contratosConsultores as &$contratoConsultor) {
        // Obtener los detalles del consultor jurídico correspondiente al ID de consultor
        $consultor = $registroConsultoriaModel->find($contratoConsultor->empleado_c_j); // Acceder al ID como una propiedad de objeto

        // Si se encuentra el consultor jurídico, asignar su nombre completo, su NIT y el nombre de la empresa al contrato
        if ($consultor) {
            // Obtener el nombre completo del consultor
            $nombreCompleto = $consultor->RepresentanteLegal_ApellidoPaterno_c_p . ' ' . $consultor->RepresentanteLegal_ApellidoMaterno_c_p . ' ' . $consultor->RepresentanteLegal_Nombres_c_p;
            $contratoConsultor->nombre_consultor = $nombreCompleto; // Asignar el nombre completo como propiedad del objeto
            
            // Obtener el NIT del consultor
            $nitConsultor = $consultor->NITEmpresa_c_p;
            $contratoConsultor->nit_consultor = $nitConsultor; // Asignar el NIT como propiedad del objeto

            // Obtener el nombre de la empresa del consultor
            $nombreEmpresa = $consultor->NombreEmpresa_c_p;
            $contratoConsultor->nombre_empresa = $nombreEmpresa; // Asignar el nombre de la empresa como propiedad del objeto
        } else {
            // Si no se encuentra el consultor, asignar valores por defecto
            $contratoConsultor->nombre_consultor = 'Desconocido';
            $contratoConsultor->nit_consultor = 'N/A';
            $contratoConsultor->nombre_empresa = 'Desconocido';
        }
    }
    unset($contratoConsultor);

    // Pasar los datos actualizados a la vista
    $data['contratos_consultores'] = $contratosConsultores;
    $data['titulo'] = "Listado de contratos de consultores jurídicos";

    // Cargar la vista para mostrar los contratos de consultores jurídicos
    return view("contratos_consultore_j/lista_contratos_juridicos", $data);
}


public function vista_formulario_edicion_contrato_j($idContrato)
{
    // Cargar el modelo de Contrato de Consultoría Jurídica
    $contratoConsultorModel = new contrato_consultor_juridico();

    // Obtener la información del contrato por su ID
    $contratoConsultor = $contratoConsultorModel->find($idContrato);

    // Verificar si el contrato existe
    if (!$contratoConsultor) {
        // Redirigir a una página de error si el contrato no existe
        return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Contrato no encontrado');
    }

    // Pasar la información del contrato a la vista
    $data['titulo'] = "Edición de contrato de consultoría";
    $data['contrato_consultor'] = $contratoConsultor;

    // Cargar la vista con los datos del contrato para editar
    return view("contratos_consultore_j/formulario_edicion_contrato_consultor_j", $data);
}
public function editarContratoConsultoria($idContrato)
{
    // Verificar si se están enviando datos del formulario
    if ($this->request->getMethod() === 'post') {
        // Recibir los datos del formulario
        $data = [];

        // Obtener los campos del formulario
        $fecha_de_inicio = $this->request->getPost('fecha_de_inicio');
        $fecha_de_finalizacion = $this->request->getPost('fecha_de_finalizacion');
        $nuevo_archivo = $this->request->getFile('nuevo_archivo');

        // Verificar si se ha enviado una nueva fecha de inicio
        if (!empty($fecha_de_inicio)) {
            $data['fecha_inicio_contrato_c_j'] = $fecha_de_inicio;
        }

        // Verificar si se ha enviado una nueva fecha de finalización
        if (!empty($fecha_de_finalizacion)) {
            $data['fecha_finalizacion_contrato_c_j'] = $fecha_de_finalizacion;
        }

        // Verificar si se ha enviado un nuevo archivo
        if ($nuevo_archivo->isValid() && !$nuevo_archivo->hasMoved()) {
            // Cargar el modelo de Contrato Consultor
            $contratoConsultorModel = new contrato_consultor_juridico();

            // Obtener la información del contrato consultor por su ID
            $contratoConsultor = $contratoConsultorModel->find($idContrato);

            // Verificar si el contrato consultor existe
            if (!$contratoConsultor) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Contrato no encontrado');
            }

            // Verificar si se encontró el ID de la empresa jurídica en el contrato
            if (empty($contratoConsultor->empleado_c_j)) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'ID de empresa jurídica no encontrado en el contrato');
            }

            // Obtener la empresa jurídica asociada al contrato
            $registroConsultoriaModel = new consultoria_persona_juridica_model();
            $empresaJuridica = $registroConsultoriaModel->find($contratoConsultor->empleado_c_j);

            // Verificar si se encontró la empresa jurídica
            if (!$empresaJuridica) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Empresa jurídica no encontrada');
            }

            // Obtener el NIT de la empresa jurídica
            $NITEmpresa_c_p = $empresaJuridica->NITEmpresa_c_p;

            // Generar el nombre del nuevo archivo
            $nuevo_nombre_archivo = $NITEmpresa_c_p . '_' . date('Y-m-d_H-i-s') . '.pdf';

            // Ruta de destino para guardar los archivos PDF de contratos
            $ruta_destino = FCPATH . 'pdfscontratos' . DIRECTORY_SEPARATOR;

            // Mover el archivo al directorio de destino
            try {
                $nuevo_archivo->move($ruta_destino, $nuevo_nombre_archivo);
                $data['archivo_c_j'] = $nuevo_nombre_archivo;
            } catch (\Exception $e) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al subir el archivo PDF: ' . $e->getMessage());
            }
        }

        // Verificar si hay datos para actualizar
        if (!empty($data)) {
            // Actualizar los datos del contrato en la base de datos
            $contratoConsultorModel = new contrato_consultor_juridico();

            try {
                $contratoConsultorModel->update($idContrato, $data);
                return redirect()->to(base_url('contrato_consultor_jj/vista_formulario_edicion_contrato_j/' . $idContrato))->with('success_message', 'Cambios guardados con éxito.');
            } catch (\Exception $e) {
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al actualizar el contrato: ' . $e->getMessage());
            }
        }
    }

    // Si no se enviaron datos del formulario, redirigir a alguna página
    return redirect()->to(base_url('ruta_por_defecto'));
}




}