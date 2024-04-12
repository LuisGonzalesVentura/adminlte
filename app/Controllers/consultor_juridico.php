<?php

namespace App\Controllers;
use App\Models\oficina;
use App\Models\ContratoModel;
use App\Models\registroconsultoria_n;
use App\Models\contrato_consultor_n;
use App\Models\contrato_consultor_juridico;
use App\Models\TipoContrato;

use App\Models\consultoria_persona_juridica_model;

class consultor_juridico extends BaseController
{


    protected $reportesModel;
    protected $oficinaModel; // Agrega esta línea

    public function __construct()
    {
        $this->consultoria_persona_juridica_model = new consultoria_persona_juridica_model();
        $this->oficinaModel = new oficina(); // Instancia el modelo de oficinas
    }

    public function vista_formulario_crear_consultores_juridicas()
    {
        // Obtén las oficinas desde el modelo
        $oficinas = $this->oficinaModel->findAll();

        // Pasa las oficinas a la vista
        $data['oficinas'] = $oficinas;

        $data['titulo'] = "Crear Consultores Persona Juridica";
        return view("consultor_juridico/crear_consultor_juridico", $data);
    }
    public function guardar_consultor_juridica()
{
    // Configura las reglas de validación según tus necesidades
    $validationRules = [
        'NombreEmpresa_c_p' => 'required',
        'SiglaEmpresa_c_p' => 'required',
        'NITEmpresa_c_p' => 'required',
        'RepresentanteLegal_ApellidoPaterno_c_p' => 'required',
        'RepresentanteLegal_Nombres_c_p' => 'required',
        'FechaInicioConsultoria_c_p' => 'required|valid_date', 
        'OficinaID_c_p' => 'required',
        'Proyecto_c_p' => 'required',
        'TemaConsultoria_c_p' => 'required',
        'ProductosEntregados_c_p' => 'required',
        'Archivo_c_p' => 'required',
        // Ajusta la regla según tus necesidades
        // Agrega más reglas según sea necesario
    ];

    // Realiza la validación
    if (!$this->validate($validationRules)) {
        // Si la validación falla, redirige al formulario con los errores
        return redirect()->to('consultor_juridico/vista_formulario_crear_consultores_juridicas')->withInput()->with('validation', $this->validator);
    }

    // Si la validación es exitosa, procede con la inserción en la base de datos
    $consultorJuridicoModel = new consultoria_persona_juridica_model();

    // Recopila los datos del formulario
    $data = [
        'NombreEmpresa_c_p' => $this->request->getPost('NombreEmpresa_c_p'),
        'SiglaEmpresa_c_p' => $this->request->getPost('SiglaEmpresa_c_p'),
        'NITEmpresa_c_p' => $this->request->getPost('NITEmpresa_c_p'),
        'RepresentanteLegal_ApellidoPaterno_c_p' => $this->request->getPost('RepresentanteLegal_ApellidoPaterno_c_p'),
        'RepresentanteLegal_ApellidoMaterno_c_p' => $this->request->getPost('RepresentanteLegal_ApellidoMaterno_c_p') ?? '', // Si no se proporciona, establece como cadena vacía
        'RepresentanteLegal_Nombres_c_p' => $this->request->getPost('RepresentanteLegal_Nombres_c_p'),
        'FechaInicioConsultoria_c_p' => $this->request->getPost('FechaInicioConsultoria_c_p'),
        'FechaConclusionConsultoria_c_p' => $this->request->getPost('FechaConclusionConsultoria_c_p') ?? '00-00-0000', // Si no se proporciona, establece como '00-00-0000'
        'OficinaID_c_p' => $this->request->getPost('OficinaID_c_p'),
        'Proyecto_c_p' => $this->request->getPost('Proyecto_c_p'),
        'TemaConsultoria_c_p' => $this->request->getPost('TemaConsultoria_c_p'),
        'ProductosEntregados_c_p' => $this->request->getPost('ProductosEntregados_c_p'),
        'Archivo_c_p' => $this->request->getPost('Archivo_c_p'),
        // ... Añadir otros campos según sea necesario
    ];

    // Guarda en la base de datos
    $consultorJuridicoModel->insert($data);

    // Redirige con un mensaje de éxito
    return redirect()->to('consultor_juridico/vista_formulario_crear_consultores_juridicas')->with('success_message', 'Consultor jurídico  creado exitosamente');
}
public function listarConsultoresJuridicos()
{
    // Instancia el modelo de consultores jurídicos
    $model = new consultoria_persona_juridica_model();
    
    // Selecciona los campos específicos que necesitas
    $data['consultores'] = $model
    ->select('consultor_persona_juridica.*, dni_filiales.nombre_filial as nombre_oficina')
    ->join('dni_filiales', 'dni_filiales.id = consultor_persona_juridica.OficinaID_c_p', 'left')
    ->orderBy('consultor_persona_juridica.RepresentanteLegal_ApellidoPaterno_c_p', 'ASC')
    ->findAll();

    // Configura la vista y muestra la lista de consultores jurídicos
    $data['titulo'] = 'Lista de Consultores Jurídicos';
    return view("consultor_juridico/index_lista_consultor_juridico", $data);
}
public function informacion_consultores_juridicos($id)
{
    // Instancia el modelo de consultores jurídicos
    $model = new consultoria_persona_juridica_model(); // Asegúrate de reemplazar 'ConsultorJuridicoModel' con el nombre correcto de tu modelo
    
    // Obtén los datos del consultor jurídico
    $consultor = $model->find($id);

    // Verifica si el consultor jurídico existe
    if ($consultor) {
        // Cargar información de la oficina relacionada
        $oficinaModel = new oficina(); // Asegúrate de reemplazar 'OficinaModel' con el nombre correcto de tu modelo de oficina
        $oficina = $oficinaModel->find($consultor->OficinaID_c_p);
        $nombreFilial = $oficina ? $oficina->nombre_filial : 'N/A';
        
        // Prepara los datos para pasar a la vista
        $data['consultor'] = $consultor;
        $data['nombreFilial'] = $nombreFilial;
        $data['titulo'] = "Información del Consultor Jurídico";
        $data['id'] = $id; // Agrega el ID del consultor a los datos que pasas a la vista
    } else {
        // Si el consultor jurídico no existe, pasa null a la vista
        $data['consultor'] = null;
        $data['nombreFilial'] = 'N/A';
        $data['titulo'] = "Información no encontrada";
        $data['id'] = null; // Puedes pasar null o un valor predeterminado para el ID
    }
    
    // Pasa los datos a la vista
    return view("consultor_juridico/informacion_consultores_juridicos", $data); // Asegúrate de reemplazar 'consultores/informacion_consultores_juridicos' con la ruta correcta a tu vista
}

public function lista_subir__pdf_consultores_juridicos()
{
 // Instancia el modelo de consultores
 $model = new consultoria_persona_juridica_model();
    
 // Selecciona los campos específicos que necesitas
 $data['consultores'] = $model
     ->select('consultor_persona_juridica.*, dni_filiales.nombre_filial as nombre_oficina')
     ->join('dni_filiales', 'dni_filiales.id = consultor_persona_juridica.OficinaID_c_p', 'left')
     ->orderBy('consultor_persona_juridica.RepresentanteLegal_ApellidoPaterno_c_p', 'ASC')
     ->findAll();
 
 // Configura la vista y muestra la lista de consultores
 $data['titulo'] = 'Lista de Consultores';
 return view("consultor_juridico/lista_subir_pdf_consultores_juridicos", $data);
}
public function formulario_pdf_consultores_j($id)
{
    // Instancia el modelo de consultores
    $model = new consultoria_persona_juridica_model();
    
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
    return view("consultor_juridico/formulario_pdf_consultores_juridicos", $data);
}


public function subir_pdf_consultor_juridica($id = null)
{
    $model = new consultoria_persona_juridica_model(); // Ajusta el modelo según corresponda

    if ($this->request->getMethod() === 'post') {
        // Obtén el ID del consultor del segmento de la URL
        $id = (int) $this->request->uri->getSegment(3);

        try {
            $files = $this->request->getFiles();

            foreach ($files as $fieldName => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    
                    // Mueve el archivo a la carpeta deseada
                    $file->move(ROOTPATH . 'public/pdfsconsultores_j', $newName);
                    
                    // Actualiza el nombre del archivo en la base de datos
                    $model->update($id, [$fieldName => $newName]);
                }
            }

            return redirect()->to('consultor_juridico/subir_pdf_consultor_juridica/' . $id)->with('success', 'PDFs subidos exitosamente.');
        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            return redirect()->to('consultor_juridico/subir_pdf_consultor_juridica/' . $id)->with('error', 'Error al subir los PDFs.');
        }
    }

    // Obtener el consultor según el ID
    $consultor = $model->find($id);

    // Comprobar si se encontró el consultor
    if (!$consultor) {
        // Si no se encontró el consultor, redireccionar con un mensaje de error
        return redirect()->to('consultor_juridico/subir_pdf_consultor_juridica')->with('error', 'Consultor no encontrado.');
    }

    // Pasar los datos del consultor a la vista
    $data['titulo'] = "Subir PDF";
    $data['id'] = $id;
    $data['consultor'] = $consultor;

    return view("consultor_juridico/formulario_pdf_consultores_juridicos", $data); // Ajusta la vista según corresponda
}
public function documentos_consultores_J($id)
    {
        $model = new consultoria_persona_juridica_model();
        
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
        return view("consultor_juridico/ver_documentos_consultor_juridico", $data);
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
            if ($consultorId === false || $consultorId === null) {
                throw new \InvalidArgumentException('ID de consultor no válido');
            }
    
            if (empty($documentType)) {
                throw new \InvalidArgumentException('Tipo de documento no especificado');
            }
    
            // Obtener el modelo y buscar el consultor por ID
            $model = new consultoria_persona_juridica_model();
            $consultor = $model->find($consultorId);
    
            // Verificar si se encontró el consultor
            if ($consultor) {
                // Convertir el objeto $consultor a un array
                $consultorArray = get_object_vars($consultor);
    
                // Verificar si el tipo de documento existe en el array
                if (array_key_exists($documentType, $consultorArray)) {
                    $pdfName = $consultorArray[$documentType];
    
                    // Devolver el nombre del archivo PDF
                    echo json_encode(['success' => true, 'pdfName' => $pdfName, 'consultorId' => $consultor->id_c_p]);
                } else {
                    // Tipo de documento no encontrado
                    echo json_encode(['success' => false, 'message' => 'Tipo de documento no encontrado para este consultor']);
                }
            } else {
                // Consultor no encontrado
                http_response_code(404); // No encontrado
                echo json_encode(['success' => false, 'message' => 'Consultor no encontrado']);
            }
        } catch (\InvalidArgumentException $e) {
            // Error en los datos de entrada
            http_response_code(400); // Solicitud incorrecta
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Exception $e) {
            // Otro error interno
            log_message('error', 'Error en getDocumento: ' . $e->getMessage());
            http_response_code(500); // Error interno del servidor
            echo json_encode(['success' => false, 'message' => 'Error interno del servidor']);
        }
    }
    

    public function formulario_editar_consultores_j($id_consultor)
{
    // Supongamos que $titulo contiene el título que quieres mostrar en la vista
    $titulo = "Editar Consultor Juridico"; 

    // Suponiendo que tienes un modelo llamado 'ConsultoresModel' para acceder a los datos de la base de datos
    $consultorModel = new consultoria_persona_juridica_model();

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
    return view("consultor_juridico/editar_consultor_juridico", $data);
}
public function guardar_edicion_consultoria_j()
{
    // Obtener el ID del consultor
    $id_consultor = $this->request->getPost('id_consultor');

    // Verificar si se proporcionó un ID de consultor válido
    if (!$id_consultor) {
        return redirect()->back()->withInput()->with('error', 'ID de consultor no válido');
    }

    // Obtener los demás datos del formulario
    $nombre_empresa = $this->request->getPost('nombre_empresa');
    $sigla_empresa = $this->request->getPost('sigla_empresa');
    $nit_empresa = $this->request->getPost('nit_empresa');
    $representante_legal_apellido_paterno = $this->request->getPost('representante_legal_apellido_paterno');
    $representante_legal_apellido_materno = $this->request->getPost('representante_legal_apellido_materno');
    $representante_legal_nombres = $this->request->getPost('representante_legal_nombres');
    $fecha_inicio_consultoria = $this->request->getPost('fecha_inicio_consultoria');
    $fecha_conclusion_consultoria = $this->request->getPost('fecha_conclusion_consultoria');
    $oficina_id = $this->request->getPost('oficina_id');
    $proyecto = $this->request->getPost('proyecto');
    $tema_consultoria = $this->request->getPost('tema_consultoria');
    $productos_entregados = $this->request->getPost('productos_entregados');
    $ubicacion = $this->request->getPost('ubicacion');

    // Validar los datos si es necesario
    // Aquí deberías agregar la lógica de validación según tus requisitos

    // Actualizar los datos en la base de datos
    $consultorModel = new consultoria_persona_juridica_model();

    // Verificar si se proporcionaron datos para actualizar
   // Verificar si se proporcionaron datos para actualizar
$dataToUpdate = [];

// Verificar y agregar datos para cada campo que se puede actualizar
if (!empty($nombre_empresa)) {
    $dataToUpdate['NombreEmpresa_c_p'] = $nombre_empresa;
}
if (!empty($sigla_empresa)) {
    $dataToUpdate['SiglaEmpresa_c_p'] = $sigla_empresa;
}
if (!empty($nit_empresa)) {
    $dataToUpdate['NITEmpresa_c_p'] = $nit_empresa;
}
if (!empty($representante_legal_apellido_paterno)) {
    $dataToUpdate['RepresentanteLegal_ApellidoPaterno_c_p'] = $representante_legal_apellido_paterno;
}
if (!empty($representante_legal_apellido_materno)) {
    $dataToUpdate['RepresentanteLegal_ApellidoMaterno_c_p'] = $representante_legal_apellido_materno;
}
if (!empty($representante_legal_nombres)) {
    $dataToUpdate['RepresentanteLegal_Nombres_c_p'] = $representante_legal_nombres;
}
if (!empty($fecha_inicio_consultoria)) {
    $dataToUpdate['FechaInicioConsultoria_c_p'] = $fecha_inicio_consultoria;
}
if (!empty($fecha_conclusion_consultoria)) {
    $dataToUpdate['FechaConclusionConsultoria_c_p'] = $fecha_conclusion_consultoria;
}
if (!empty($oficina_id)) {
    $dataToUpdate['OficinaID_c_p'] = $oficina_id;
}
if (!empty($proyecto)) {
    $dataToUpdate['Proyecto_c_p'] = $proyecto;
}
if (!empty($tema_consultoria)) {
    $dataToUpdate['TemaConsultoria_c_p'] = $tema_consultoria;
}
if (!empty($productos_entregados)) {
    $dataToUpdate['ProductosEntregados_c_p'] = $productos_entregados;
}
if (!empty($ubicacion)) {
    $dataToUpdate['Archivo_c_p'] = $ubicacion;
}

// Agregar otras condiciones de actualización aquí...

// Verificar si hay datos para actualizar
if (empty($dataToUpdate)) {
    return redirect()->back()->withInput()->with('error', 'No se proporcionaron datos para actualizar');
}


    // Actualizar los datos
    $consultorModel->update($id_consultor, $dataToUpdate);

    // Redirigir después de guardar los cambios
    return redirect()->to(base_url("consultor_juridico/guardar_edicion_consultoria_j/$id_consultor"));
}
public function ver_contrato_consultores_j($id)
{
    // Cargar el modelo de Contrato Consultor Jurídico
    $contratoConsultorModel = new contrato_consultor_juridico();

    // Obtener los contratos del consultor jurídico por su ID
    $contratosConsultores = $contratoConsultorModel->where('empleado_c_j', $id)->findAll();

    // Verificar si se encontraron contratos para el consultor jurídico
    if (!$contratosConsultores) {
        // Redirigir directamente a una página específica
        return view("consultor_juridico/ver_contratos_juridico");
    }

    // Pasar los datos de los contratos a la vista
    return view("consultor_juridico/ver_contratos_juridico", [
        'contratosConsultores' => $contratosConsultores
    ]);
}




}