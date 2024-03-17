<?php

namespace App\Controllers;
use App\Models\oficina;
use App\Models\ContratoModel;
use App\Models\registroconsultoria_n;
use App\Models\contrato_consultor_n;

class consultores extends BaseController
{


    protected $reportesModel;
    protected $oficinaModel; // Agrega esta línea

    public function __construct()
    {
        $this->registroconsultoriaModel = new registroconsultoria_n();
        $this->oficinaModel = new oficina(); // Instancia el modelo de oficinas
    }

    public function vista_formulario_crear_consultores_natural()
    {
        // Obtén las oficinas desde el modelo
        $oficinas = $this->oficinaModel->findAll();

        // Pasa las oficinas a la vista
        $data['oficinas'] = $oficinas;

        $data['titulo'] = "Crear Consultores Persona Natural";
        return view("consultores/crear_colsultores_natural", $data);
    }


    public function guardar_consultor_natural()
{
    // Configura las reglas de validación según tus necesidades
    $validationRules = [
        'carnet_identidad_n' => 'required',
        'nua_n' => 'required',
        'nit_n' => 'required',
        'apellido_paterno_n' => 'required',
        'apellido_materno_n' => 'required',
        'nombres_n' => 'required',
        'genero_n' => 'required',
        'inicio_servicio_n' => 'required|valid_date', 
        'oficina_id' => 'required',
        // Ajusta la regla según tus necesidades
        // Agrega más reglas según sea necesario
    ];

    // Realiza la validación
    if (!$this->validate($validationRules)) {
        // Si la validación falla, redirige al formulario con los errores
        return redirect()->to('consultores/crear_consultor_natural')->withInput()->with('validation', $this->validator);
    }

    // Si la validación es exitosa, procede con la inserción en la base de datos
    $registroConsultoriaModel = new RegistroConsultoria_n();

    // Recopila los datos del formulario
    $data = [
        'carnet_identidad_n' => $this->request->getPost('carnet_identidad_n'),
        'nua_n' => $this->request->getPost('nua_n'),
        'nit_n' => $this->request->getPost('nit_n'),
        'apellido_paterno_n' => $this->request->getPost('apellido_paterno_n'),
        'apellido_materno_n' => $this->request->getPost('apellido_materno_n'),
        'nombres_n' => $this->request->getPost('nombres_n'),
        'genero_n' => $this->request->getPost('genero_n'),
        'inicio_servicio_n' => $this->request->getPost('inicio_servicio_n'),
        'conclusion_servicio_n' => $this->request->getPost('conclusion_servicio_n'),
        'oficina_id' => $this->request->getPost('oficina_id'),
        'proyecto_n' => $this->request->getPost('proyecto_n'),
        'tema_consultoria_n' => $this->request->getPost('tema_consultoria_n'),
        'productos_entregados_n' => $this->request->getPost('productos_entregados_n'),
        'ubicacion_n' => $this->request->getPost('ubicacion_n'), 
        // ... Añadir otros campos según sea necesario
    ];

    // Guarda en la base de datos
    $registroConsultoriaModel->insert($data);

    // Redirige con un mensaje de éxito
    return redirect()->to('consultores/vista_formulario_crear_consultores_natural')->with('success_message', 'Consultor creado exitosamente');
}

public function listarConsultores_n()
{
    // Instancia el modelo de consultores
    $model = new registroconsultoria_n();
    
    // Selecciona los campos específicos que necesitas
    $data['consultores'] = $model
        ->select('registroconsultoria.*, dni_filiales.nombre_filial as nombre_oficina')
        ->join('dni_filiales', 'dni_filiales.id = registroconsultoria.oficina_id', 'left')
        ->orderBy('registroconsultoria.apellido_paterno_n', 'ASC')
        ->findAll();
    
    // Configura la vista y muestra la lista de consultores
    $data['titulo'] = 'Lista de Consultores';
    return view("consultores/index_lista_consultores_n", $data);
}
public function informacion_consultores($id)
{
    // Instancia el modelo de consultores
    $model = new registroconsultoria_n();
    
    // Obtén los datos del consultor
    $consultor = $model->find($id);

    // Verifica si el consultor existe
    if ($consultor) {
        // Cargar información de la oficina relacionada
        $oficinaModel = new Oficina();
        $oficina = $oficinaModel->find($consultor->oficina_id);
        $nombreFilial = $oficina ? $oficina->nombre_filial : 'N/A';
        
        // Prepara los datos para pasar a la vista
        $data['consultor'] = $consultor;
        $data['nombreFilial'] = $nombreFilial;
        $data['titulo'] = "Información del Consultor";
        $data['id'] = $id; // Agrega el ID del consultor a los datos que pasas a la vista
    } else {
        // Si el consultor no existe, pasa null a la vista
        $data['consultor'] = null;
        $data['nombreFilial'] = 'N/A';
        $data['titulo'] = "Información no encontrada";
        $data['id'] = null; // Puedes pasar null o un valor predeterminado para el ID
    }
    
    // Pasa los datos a la vista
    return view("consultores/informacion_consultores", $data);
}


public function lista_vista_formulario_subir_pdf_consultores()
{
 // Instancia el modelo de consultores
 $model = new registroconsultoria_n();
    
 // Selecciona los campos específicos que necesitas
 $data['consultores'] = $model
     ->select('registroconsultoria.*, dni_filiales.nombre_filial as nombre_oficina')
     ->join('dni_filiales', 'dni_filiales.id = registroconsultoria.oficina_id', 'left')
     ->orderBy('registroconsultoria.apellido_paterno_n', 'ASC')
     ->findAll();
 
 // Configura la vista y muestra la lista de consultores
 $data['titulo'] = 'Lista de Consultores';
 return view("consultores/lista_vista_formulario_subir_pdf_consultores", $data);
}

public function formulario_pdf_consultores_n($id)
{
    // Instancia el modelo de consultores
    $model = new registroconsultoria_n();
    
    // Obtén los datos del consultor
    $consultor = $model->find($id);

    // Verifica si el consultor existe
    if ($consultor) {
        // Pasa los datos del consultor a la vista
        $data['consultor'] = $consultor;
        $data['titulo'] = "Información del Consultor";
        $data['id'] = $id; // Pasa el id a la vista
    } else {
        // Si el consultor no existe, pasa null a la vista
        $data['consultor'] = null;
        $data['titulo'] = "Información no encontrada";
    }
    
    // Pasa los datos a la vista
    return view("consultores/formulario_pdf_consultores_n", $data);
}
public function subir_pdf_consultor_natural($id = null)
{
    $model = new registroconsultoria_n();

    if ($this->request->getMethod() === 'post') {
        // Obtén el ID del consultor del segmento de la URL
        $id = (int) $this->request->uri->getSegment(3);

        try {
            $files = $this->request->getFiles();

            foreach ($files as $fieldName => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/pdfsconsultores_n', $newName);
                    
                    // Actualiza el nombre del archivo en la base de datos
                    $model->update($id, [$fieldName => $newName]);
                }
            }

            return redirect()->to('consultores/subir_pdf_consultor_natural/' . $id)->with('success', 'PDFs subidos exitosamente.');
        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            return redirect()->to('consultores/subir_pdf_consultor_natural/' . $id)->with('error', 'Error al subir los PDFs.');
        }
    }

    // Obtener el consultor según el ID
    $consultor = $model->find($id);

    // Comprobar si se encontró el consultor
    if (!$consultor) {
        // Si no se encontró el consultor, redireccionar con un mensaje de error
        return redirect()->to('consultores/subir_pdf_consultor_natural')->with('error', 'Consultor no encontrado.');
    }

    // Pasar los datos del consultor a la vista
    $data['titulo'] = "Subir PDF";
    $data['id'] = $id;
    $data['consultor'] = $consultor;

    return view("consultores/formulario_pdf_consultores_n", $data);
}


protected function processFile($file, $fieldName, $id)
{
    try {
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/pdfsconsultores_n', $newName);
            $model = new registroconsultoria_n();
            $consultor = $model->find($id);

            // Verifica si el consultor existe
            if ($consultor) {
                // Actualiza el campo correspondiente del consultor en la base de datos
                $consultor->$fieldName = $newName;
                $model->save($consultor);

                // Retorna un arreglo con éxito y el mensaje correspondiente
                return ['success' => true, 'message' => "Archivo '$fieldName' subido con éxito."];
            } else {
                // Retorna un arreglo con error y el mensaje correspondiente
                return ['success' => false, 'message' => 'El consultor no existe.'];
            }
        } else {
            // Retorna un arreglo con error y el mensaje correspondiente
            return ['success' => false, 'message' => "El archivo '$fieldName' no es válido."];
        }
    } catch (\Exception $e) {
        // Log del error
        \config\Services::logger()->error("Error al procesar el archivo $fieldName: " . $e->getMessage());

        // Retorna un arreglo con error y el mensaje correspondiente
        return ['success' => false, 'message' => "Error al procesar el archivo '$fieldName'."];
    }
}



public function documentos_consultores_n($id)
    {
        $model = new registroconsultoria_n();
        
        // Obtén los datos del consultor
        $consultor = $model->find($id);

        // Verifica si el consultor existe
        if ($consultor) {
            // Pasa los datos del consultor a la vista
            $data['consultor'] = $consultor;
            $data['titulo'] = "Información del Consultor";
            $data['id'] = $id; // Pasa el id a la vista
        } else {
            // Si el consultor no existe, pasa null a la vista
            $data['consultor'] = null;
            $data['titulo'] = "Información no encontrada";
        }
        
        // Pasa los datos a la vista
        return view("consultores/ver_documentos_consultores_n", $data);
    }

    public function getDocumento()
    {
        try {
            $documentType = $this->request->getVar('type');
            $consultorId = $this->request->getVar('id');

            // Validar y sanear datos de entrada
            $documentType = filter_var($documentType, FILTER_SANITIZE_STRING);
            $consultorId = filter_var($consultorId, FILTER_VALIDATE_INT);

            // Verificar si los datos son válidos
            if ($consultorId === false || $consultorId === null || empty($documentType)) {
                throw new \InvalidArgumentException('Invalid input data');
            }

            // Obtener el modelo y buscar el consultor por ID
            $model = new registroconsultoria_n();
            $consultor = $model->find($consultorId);

            // Verificar si se encontró el consultor
            if ($consultor) {
                // Convertir el objeto $consultor a un array
                $consultorArray = get_object_vars($consultor);

                // Verificar si el tipo de documento existe en el array
                if (array_key_exists($documentType, $consultorArray)) {
                    $pdfName = $consultorArray[$documentType];

                    // Devolver el nombre del archivo PDF
                    echo json_encode(['success' => true, 'pdfName' => $pdfName, 'consultorId' => $consultor->consultoria_id_n]);
                } else {
                    // Tipo de documento no encontrado
                    echo json_encode(['success' => false, 'message' => 'Document type not found for this consultor']);
                }
            } else {
                // Consultor no encontrado
                http_response_code(404); // Not Found
                echo json_encode(['success' => false, 'message' => 'Consultor not found']);
            }
        } catch (\InvalidArgumentException $e) {
            // Error en los datos de entrada
            http_response_code(400); // Bad Request
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Exception $e) {
            // Otro error interno
            log_message('error', 'Error in getDocumento: ' . $e->getMessage());
            http_response_code(500); // Internal Server Error
            echo json_encode(['success' => false, 'message' => 'Internal Server Error']);
        }
    }
    // En tu controlador
public function formulario_editar_consultores_n($id_consultor)
{
    // Supongamos que $titulo contiene el título que quieres mostrar en la vista
    $titulo = "Editar Consultor"; 

    // Suponiendo que tienes un modelo llamado 'ConsultoresModel' para acceder a los datos de la base de datos
    $consultorModel = new registroconsultoria_n();

    // Obtener los datos del consultor con el ID proporcionado
    $consultor = $consultorModel->find($id_consultor);

    // Suponiendo que también tienes un modelo llamado 'OficinasModel' para acceder a los datos de las oficinas
    $oficinasModel = new Oficina();

    // Obtener todas las oficinas para llenar el select en el formulario
    $oficinas = $oficinasModel->findAll();

    // Pasar los datos del consultor y las oficinas a la vista
    $data = [
        'titulo' => $titulo,
        'consultor' => $consultor,
        'oficinas' => $oficinas
    ];

    // Cargar la vista del formulario de edición de consultores_n
    return view("consultores/editar_consultor_n", $data);
}
public function guardar_edicion_consultoria_n()
{
    // Obtener los datos del formulario
    $id_consultor = $this->request->getPost('id_consultor');
    $carnet_identidad = $this->request->getPost('carnet_identidad');
    $nua = $this->request->getPost('nua');
    $nit_n = $this->request->getPost('nit_n');
    $apellido_paterno = $this->request->getPost('apellido_paterno');
    $apellido_materno = $this->request->getPost('apellido_materno');
    $nombres = $this->request->getPost('nombres');
    $genero = $this->request->getPost('genero');
    $inicio_servicio = $this->request->getPost('inicio_servicio');
    $conclusion_servicio = $this->request->getPost('conclusion_servicio');
    $oficina_id = $this->request->getPost('oficina_id');
    $proyecto = $this->request->getPost('proyecto');
    $tema_consultoria = $this->request->getPost('tema_consultoria');
    $productos_entregados = $this->request->getPost('productos_entregados');
    $ubicacion = $this->request->getPost('ubicacion');

    // Validar los datos si es necesario

    // Actualizar los datos en la base de datos
    $consultorModel = new registroconsultoria_n();
    $data = [
        'carnet_identidad_n' => $carnet_identidad,
        'nua_n' => $nua,
        'nit_n' => $nit_n,

        'apellido_paterno_n' => $apellido_paterno,
        'apellido_materno_n' => $apellido_materno,
        'nombres_n' => $nombres,
        'genero_n' => $genero,
        'inicio_servicio_n' => $inicio_servicio,
        'conclusion_servicio_n' => $conclusion_servicio,
        'oficina_id' => $oficina_id,
        'proyecto_n' => $proyecto,
        'tema_consultoria_n' => $tema_consultoria,
        'productos_entregados_n' => $productos_entregados,
        'ubicacion_n' => $ubicacion
    ];
    $consultorModel->update($id_consultor, $data);

    // Redirigir a alguna página después de guardar los cambios, por ejemplo, a la página de inicio
    return redirect()->to(base_url("Consultores/formulario_editar_consultores_n/$id_consultor"));
}

public function ver_contrato_consultores_n($id)
{
    // Cargar el modelo de Consultores
    $consultoresModel = new registroconsultoria_n();

    // Obtener los detalles de la consultoría por su ID
    $consultoria = $consultoresModel->find($id);

    // Verificar si la consultoría existe
    if (!$consultoria) {
        // Puedes manejar el caso en el que la consultoría no exista, por ejemplo, redirigiendo a una página de error
        return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Consultoría no encontrada');
    }

    // Cargar el modelo de Contrato Consultor
    $contratoConsultorModel = new contrato_consultor_n();

    // Obtener los contratos de consultores relacionados con el ID de la consultoría
    $contratosConsultores = $contratoConsultorModel->getContratosByConsultorId($id);

    // Pasar los datos de los contratos y detalles de la consultoría a la vista
    return view("Consultores/ver_contratos_consultores_n", [
        'contratosConsultores' => $contratosConsultores,
        'consultoria' => $consultoria
    ]);
}


}