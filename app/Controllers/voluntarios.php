<?php

namespace App\Controllers;

use App\Models\oficina;
use App\Models\ContratoModel;
use App\Models\registroconsultoria_n;
use App\Models\contrato_consultor_n;
use App\Models\contrato_voluntario;
use App\Models\TipoContrato;
use App\Models\VoluntarioModel;

class Voluntarios extends BaseController
{
    protected $oficinaModel;

    public function __construct()
    {
        $this->oficinaModel = new oficina();
    }

    public function vista_formulario_crear_voluntario()
    {
        // Obtener las oficinas desde el modelo
        $oficinas = $this->oficinaModel->findAll();

        // Pasar las oficinas a la vista
        $data['oficinas'] = $oficinas;
        $data['titulo'] = "Crear Voluntario";

        return view("voluntarios/crear_voluntarios", $data);
    }

    public function guardar_voluntario()
{
    // Configura las reglas de validación según tus necesidades
    $validationRules = [
        'carnet_identidad_v' => 'required',
        'apellido_paterno_v' => 'required',
        'apellido_materno_v' => 'permit_empty',
        'nombres_v' => 'required',
        'genero_v' => 'required',
        'fecha_inicio_servicio_v' => 'required|valid_date', 
        'id_oficina_v' => 'required',
        'proyecto_v' => 'required',
        'area_voluntariado_v' => 'required',
        'productos_entregados_v' => 'required',
        'archivo_v' => 'required',
        // Ajusta la regla según tus necesidades
        // Agrega más reglas según sea necesario
    ];

    // Realiza la validación
    if (!$this->validate($validationRules)) {
        // Si la validación falla, redirige al formulario con los errores
        return redirect()->to('ruta_del_formulario_de_voluntarios')->withInput()->with('validation', $this->validator);
    }

    // Si la validación es exitosa, procede con la inserción en la base de datos
    $voluntarioModel = new VoluntarioModel();

    // Recopila los datos del formulario
    $data = [
        'carnet_identidad_v' => $this->request->getPost('carnet_identidad_v'),
        'apellido_paterno_v' => $this->request->getPost('apellido_paterno_v'),
        'apellido_materno_v' => $this->request->getPost('apellido_materno_v') ?? '', // Si no se proporciona, establece como cadena vacía
        'nombres_v' => $this->request->getPost('nombres_v'),
        'genero_v' => $this->request->getPost('genero_v'),
        'fecha_inicio_servicio_v' => $this->request->getPost('fecha_inicio_servicio_v'),
        'fecha_conclusion_servicio_v' => $this->request->getPost('fecha_conclusion_servicio_v') ?? '0000-00-00', // Si no se proporciona, establece como '0000-00-00'
        'tipo_voluntariado_v' => $this->request->getPost('tipo_voluntariado_v') ?? '', // Si no se proporciona, establece como cadena vacía
        'universidad_instituto_v' => $this->request->getPost('universidad_instituto_v') ?? '', // Si no se proporciona, establece como cadena vacía
        'carrera_especialidad_v' => $this->request->getPost('carrera_especialidad_v') ?? '', // Si no se proporciona, establece como cadena vacía
        'id_oficina_v' => $this->request->getPost('id_oficina_v'),
        'proyecto_v' => $this->request->getPost('proyecto_v'),
        'area_voluntariado_v' => $this->request->getPost('area_voluntariado_v'),
        'productos_entregados_v' => $this->request->getPost('productos_entregados_v'),
        'archivo_v' => $this->request->getPost('archivo_v'),
        // ... Añadir otros campos según sea necesario
    ];

    // Guarda en la base de datos
    $voluntarioModel->insert($data);

    // Redirige con un mensaje de éxito
    return redirect()->to('voluntarios/vista_formulario_crear_voluntario')->with('success_message', 'Voluntario creado exitosamente');

}
public function listarVoluntarios()
{
    // Instancia el modelo de voluntarios
    $voluntarioModel = new VoluntarioModel();
    
    // Selecciona los campos específicos que necesitas
    $data['voluntarios'] = $voluntarioModel
        ->select('voluntarios.*, dni_filiales.nombre_filial as nombre_oficina')
        ->join('dni_filiales', 'dni_filiales.id = voluntarios.id_oficina_v', 'left')
        ->orderBy('voluntarios.apellido_paterno_v', 'ASC')
        ->findAll();

    // Configura la vista y muestra la lista de voluntarios
    $data['titulo'] = 'Lista de Voluntarios';
    return view("voluntarios/index_lista_voluntarios", $data);
}
public function informacion_voluntario($id_voluntario)
{
    // Instancia el modelo de voluntarios
    $model = new VoluntarioModel(); // Reemplaza 'ModeloDeVoluntarios' con el nombre correcto de tu modelo de voluntarios
    
    // Obtiene los datos del voluntario según su ID
    $voluntario = $model->find($id_voluntario);

    // Verifica si el voluntario existe
    if ($voluntario) {
        // Cargar información de la oficina relacionada si es necesario
        // $oficinaModel = new OficinaModel(); // Asegúrate de reemplazar 'OficinaModel' con el nombre correcto de tu modelo de oficina
        // $oficina = $oficinaModel->find($voluntario->id_oficina_v);
        // $nombreOficina = $oficina ? $oficina->nombre_oficina : 'N/A';
        $oficinaModel = new oficina(); // Asegúrate de reemplazar 'OficinaModel' con el nombre correcto de tu modelo de oficina
        $oficina = $oficinaModel->find($voluntario->id_oficina_v);
        $nombreFilial = $oficina ? $oficina->nombre_filial : 'N/A';
        // Prepara los datos para pasar a la vista
        $data['voluntario'] = $voluntario;
        $data['nombreFilial'] = $nombreFilial;
        $data['titulo'] = "Información del Voluntario";
        $data['id_voluntario'] = $id_voluntario; // Agrega el ID del voluntario a los datos que pasas a la vista
    } else {
        // Si el voluntario no existe, pasa null a la vista
        $data['voluntario'] = null;
        $data['nombreFilial'] = 'N/A';
        $data['titulo'] = "Información no encontrada";
        $data['id_voluntario'] = null; // Puedes pasar null o un valor predeterminado para el ID
    }
    
    // Pasa los datos a la vista
    return view("voluntarios/informacion_voluntarios", $data); // Asegúrate de reemplazar 'ruta/a/tu/vista/informacion_voluntario' con la ruta correcta a tu vista
}
public function lista_subir_pdf_voluntarios()
{
    // Instancia el modelo de voluntarios
    $model = new VoluntarioModel(); // Asegúrate de reemplazar 'VoluntarioModel' con el nombre correcto de tu modelo de voluntarios
    
    // Selecciona los campos específicos que necesitas
    $data['voluntarios'] = $model
        ->select('voluntarios.*, dni_filiales.nombre_filial as nombre_oficina')
        ->join('dni_filiales', 'dni_filiales.id = voluntarios.id_oficina_v', 'left')
        ->orderBy('voluntarios.apellido_paterno_v', 'ASC')
        ->findAll();
    
    // Configura la vista y muestra la lista de voluntarios
    $data['titulo'] = 'Lista de Voluntarios';
    return view("voluntarios/lista_subir_pdf_voluntario", $data); // Reemplaza 'ruta/a/tu/vista/lista_subir_pdf_voluntarios' con la ruta correcta a tu vista
}
public function formulario_pdf_voluntarios($id)
{
    // Instancia el modelo de voluntarios
    $model = new VoluntarioModel();
    
    // Obtén los datos del voluntario
    $voluntario = $model->find($id);

    // Verifica si el voluntario existe
    if ($voluntario) {
        // Pasa los datos del voluntario a la vista
        $data['voluntario'] = $voluntario;
        $data['titulo'] = "Información del Voluntario";
        $data['id'] = $id; // Pasa el id a la vista
    } else {
        // Si el voluntario no existe, pasa null a la vista
        $data['voluntario'] = null;
        $data['titulo'] = "Información no encontrada";
    }
    
    // Pasa los datos a la vista
    return view("voluntarios/formulario_pdf_voluntarios", $data);
}
public function subir_pdf_voluntario($id = null)
{
    $model = new VoluntarioModel(); // Ajusta el modelo según corresponda

    if ($this->request->getMethod() === 'post') {
        // Obtén el ID del voluntario del segmento de la URL
        $id = (int) $this->request->uri->getSegment(3);

        try {
            $files = $this->request->getFiles();

            foreach ($files as $fieldName => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $extension = $file->getClientExtension();
                    // Obtener el voluntario para incluir su carnet en el nombre del archivo
                    $voluntario = $model->find($id);
                    // Generar el nuevo nombre del archivo con el carnet del voluntario
                    $newName = $voluntario->carnet_identidad_v . '_' . uniqid() . '.' . $extension;
                    
                    // Mueve el archivo a la carpeta deseada con el nuevo nombre
                    $file->move(ROOTPATH . 'public/pdfs_voluntarios', $newName);
                    
                    // Actualiza el nombre del archivo en la base de datos
                    $model->update($id, [$fieldName => $newName]);
                }
            }
            
            return redirect()->to('voluntarios/lista_subir_pdf_voluntarios/' . $id)->with('success', 'PDFs subidos exitosamente.');
        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            return redirect()->to('ruta_para_subir_pdf_voluntario/' . $id)->with('error', 'Error al subir los PDFs.');
        }
    }

    // Obtener el voluntario según el ID
    $voluntario = $model->find($id);

    // Comprobar si se encontró el voluntario
    if (!$voluntario) {
        // Si no se encontró el voluntario, redireccionar con un mensaje de error
        return redirect()->to('ruta_para_subir_pdf_voluntario')->with('error', 'Voluntario no encontrado.');
    }

    // Pasar los datos del voluntario a la vista
    $data['titulo'] = "Subir PDF";
    $data['id'] = $id;
    $data['voluntario'] = $voluntario;

    return view("voluntarios/lista_subir_pdf_voluntario", $data); // Ajusta la vista según corresponda
}
public function documentos_voluntarios($id)
{
    $model = new VoluntarioModel();
    
    // Obtén los datos del voluntario
    $voluntario = $model->find($id);

    // Verifica si el voluntario existe
    if ($voluntario) {
        // Pasa los datos del voluntario a la vista
        $data['voluntario'] = $voluntario;
        $data['titulo'] = "Información del Voluntario";
        $data['id'] = $id; // Pasa el ID a la vista
    } else {
        // Si el voluntario no existe, pasa null a la vista
        $data['voluntario'] = null;
        $data['titulo'] = "Información no encontrada";
    }
    
    // Pasa los datos a la vista
    return view("voluntarios/ver_documentos_voluntarios", $data);
}
public function getDocumentoVoluntario()
{
    try {
        $documentType = $this->request->getVar('type');
        $id_voluntario = $this->request->getVar('id');

        // Validar y sanear datos de entrada
        $documentType = filter_var($documentType, FILTER_SANITIZE_STRING);
        $id_voluntario = filter_var($id_voluntario, FILTER_VALIDATE_INT);

        // Verificar si los datos son válidos
        if ($id_voluntario === false || $id_voluntario === null) {
            throw new \InvalidArgumentException('ID de voluntario no válido');
        }

        if (empty($documentType)) {
            throw new \InvalidArgumentException('Tipo de documento no especificado');
        }

        // Obtener el modelo y buscar el voluntario por ID
        $model = new VoluntarioModel();
        $voluntario = $model->find($id_voluntario);

        // Verificar si se encontró el voluntario
        if ($voluntario) {
            // Convertir el objeto $voluntario a un array
            $voluntarioArray = get_object_vars($voluntario);

            // Verificar si el tipo de documento existe en el array
            if (array_key_exists($documentType, $voluntarioArray)) {
                $pdfName = $voluntarioArray[$documentType];

                // Devolver el nombre del archivo PDF
                echo json_encode(['success' => true, 'pdfName' => $pdfName, 'voluntarioId' => $voluntario->id_voluntario]);
            } else {
                // Tipo de documento no encontrado
                echo json_encode(['success' => false, 'message' => 'Tipo de documento no encontrado para este voluntario']);
            }
        } else {
            // Voluntario no encontrado
            http_response_code(404); // No encontrado
            echo json_encode(['success' => false, 'message' => 'Voluntario no encontrado']);
        }
    } catch (\InvalidArgumentException $e) {
        // Error en los datos de entrada
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } catch (\Exception $e) {
        // Otro error interno
        log_message('error', 'Error en getDocumentoVoluntario: ' . $e->getMessage());
        http_response_code(500); // Error interno del servidor
        echo json_encode(['success' => false, 'message' => 'Error interno del servidor']);
    }
}
public function formulario_editar_voluntario($id_voluntario)
{
    // Título para mostrar en la vista
    $titulo = "Editar Voluntario";

    // Modelo para acceder a los datos de los voluntarios
    $voluntarioModel = new VoluntarioModel();

    // Obtener los datos del voluntario con el ID proporcionado
    $voluntario = $voluntarioModel->find($id_voluntario);

    // Modelo para acceder a los datos de las oficinas
    $oficinaModel = new oficina();

    // Obtener todas las oficinas para llenar el select en el formulario
    $oficinas = $oficinaModel->findAll();

    // Pasar los datos del voluntario y las oficinas a la vista
    $data = [
        'titulo' => $titulo,
        'voluntario' => $voluntario,
        'oficinas' => $oficinas
    ];

    // Cargar la vista del formulario de edición de voluntarios
    return view("voluntarios/editar_voluntario", $data);
}
public function guardar_edicion_voluntario()
{
    // Obtener el ID del voluntario
    $id_voluntario = $this->request->getPost('id_voluntario');

    // Verificar si se proporcionó un ID de voluntario válido
    if (!$id_voluntario) {
        return redirect()->back()->withInput()->with('error', 'ID de voluntario no válido');
    }

    $carnet = $this->request->getPost('carnet_identidad');
    $apellido_paterno = $this->request->getPost('apellido_paterno');
    $apellido_materno = $this->request->getPost('apellido_materno');
    $nombres = $this->request->getPost('nombres');
    $genero = $this->request->getPost('genero');
    $fecha_inicio_servicio = $this->request->getPost('fecha_inicio_servicio');
    $fecha_conclusion_servicio = $this->request->getPost('fecha_conclusion_servicio');
    $tipo_voluntariado = $this->request->getPost('tipo_voluntariado');
    $universidad_instituto = $this->request->getPost('universidad_instituto');
    $carrera_especialidad = $this->request->getPost('carrera_especialidad');
    $id_oficina = $this->request->getPost('id_oficina');
    $proyecto = $this->request->getPost('proyecto');
    $area_voluntariado = $this->request->getPost('area_voluntariado');
    $productos_entregados = $this->request->getPost('productos_entregados');
    $ubicacion = $this->request->getPost('ubicacion');
    $archivo = $this->request->getPost('archivo');

    // Validar los datos si es necesario
    // Aquí deberías agregar la lógica de validación según tus requisitos

    // Actualizar los datos en la base de datos
    $voluntarioModel = new VoluntarioModel();

    // Verificar si se proporcionaron datos para actualizar
    $dataToUpdate = [];

    // Verificar y agregar datos para cada campo que se puede actualizar
    if (!empty($carnet)) {
        $dataToUpdate['carnet_identidad_v'] = $carnet;
    }
    if (!empty($apellido_paterno)) {
        $dataToUpdate['apellido_paterno_v'] = $apellido_paterno;
    }
    if (!empty($apellido_materno)) {
        $dataToUpdate['apellido_materno_v'] = $apellido_materno;
    }
    if (!empty($nombres)) {
        $dataToUpdate['nombres_v'] = $nombres;
    }
    if (!empty($genero)) {
        $dataToUpdate['genero_v'] = $genero;
    }
    if (!empty($fecha_inicio_servicio)) {
        $dataToUpdate['fecha_inicio_servicio_v'] = $fecha_inicio_servicio;
    }
    if (!empty($fecha_conclusion_servicio)) {
        // Si la fecha de conclusión del servicio se proporciona, asignarla
        $dataToUpdate['fecha_conclusion_servicio_v'] = $fecha_conclusion_servicio;
    } else {
        // Si la fecha de conclusión del servicio no se proporciona, asignar un valor por defecto
        $dataToUpdate['fecha_conclusion_servicio_v'] = '0000-00-00';
    }
    if (!empty($tipo_voluntariado)) {
        $dataToUpdate['tipo_voluntariado_v'] = $tipo_voluntariado;
    }
    if (!empty($universidad_instituto)) {
        $dataToUpdate['universidad_instituto_v'] = $universidad_instituto;
    }
    if (!empty($carrera_especialidad)) {
        $dataToUpdate['carrera_especialidad_v'] = $carrera_especialidad;
    }
    if (!empty($id_oficina)) {
        $dataToUpdate['id_oficina_v'] = $id_oficina;
    }
    if (!empty($proyecto)) {
        $dataToUpdate['proyecto_v'] = $proyecto;
    }
    if (!empty($area_voluntariado)) {
        $dataToUpdate['area_voluntariado_v'] = $area_voluntariado;
    }
    if (!empty($productos_entregados)) {
        $dataToUpdate['productos_entregados_v'] = $productos_entregados;
    }
    if (!empty($ubicacion)) {
        $dataToUpdate['ubicacion_v'] = $ubicacion;
    }
    if (!empty($archivo)) {
        $dataToUpdate['archivo_v'] = $archivo;
    }

    // Agregar otras condiciones de actualización aquí...

    // Verificar si hay datos para actualizar
    if (empty($dataToUpdate)) {
        return redirect()->back()->withInput()->with('error', 'No se proporcionaron datos para actualizar');
    }

    // Actualizar los datos
    $voluntarioModel->update($id_voluntario, $dataToUpdate);

    // Redirigir después de guardar los cambios
    return redirect()->to(base_url("voluntarios/formulario_editar_voluntario/$id_voluntario"));
}
public function ver_contrato_voluntarios($id)
{
    // Cargar el modelo de Contrato Voluntario
    $contratoVoluntarioModel = new contrato_voluntario();

    // Obtener los contratos del voluntario por su ID
    $contratosVoluntarios = $contratoVoluntarioModel->where('Voluntario_id', $id)->findAll();

    // Verificar si se encontraron contratos para el voluntario
    if (!$contratosVoluntarios) {
        // Redirigir directamente a una página específica
        return view("voluntarios/ver_contratos_voluntarios");
    }

    // Pasar los datos de los contratos a la vista
    return view("voluntarios/ver_contratos_voluntarios", [
        'contratosVoluntarios' => $contratosVoluntarios
    ]);
}

}
