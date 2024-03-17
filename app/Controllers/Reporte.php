<?php 

namespace App\Controllers;
use App\Models\Reportes;
use App\Models\oficina;
use App\Models\ContratoModel;
use App\Models\finiquito_model;


class Reporte extends BaseController
{

    protected $reportesModel;
    protected $oficinaModel;

    public function __construct()
    {
        // Carga el modelo en el constructor
        $this->reportesModel = new Reportes();
         

          // Carga el modelo de oficina en el constructor
          $this->oficinaModel = new oficina(); // Ajusta según el nombre de tu modelo de oficina
        }

        public function index()
        {
            $model = new Reportes();
            $data['reportes'] = $model
    ->join('dni_filiales', 'dni_filiales.id = reportes.oficina_id', 'left')
    ->select('reportes.*, dni_filiales.nombre_filial as nombre_oficina')
    ->orderBy('apellido', 'ASC')
    ->findAll();

            $data['titulo'] = "Lista reporte";
        
            return view("reporte/index", $data);
        }
        

 
        public function ver($id)
        {
            $model = new Reportes();
            $reporte = $model->find($id);
        
            $data['titulo'] = "Informacion";
        
            if ($reporte) {
                // Cargar información de la oficina relacionada
                $oficinaModel = new Oficina();
                $reporte->oficina = $oficinaModel->find($reporte->oficina_id);
        
                $data['reporte'] = $reporte;
            } else {
                $data['reporte'] = null;
            }
        
            $data['id'] = $id;
            return view("reporte/verreporte", $data);
        }
        
    

   
    
    public function documentos($id)
    {
        $model = new Reportes();
        $data['reportes'] = $model->where('Idreporte', $id)->orderBy('Idreporte', 'ASC')->findAll();
        $data['titulo'] = "documentos";
        return view("reporte/documentos", $data);
    }

   // Controller (Reporte.php)
// Controller (Reporte.php)
public function contratos($id)
{
    // Load the ContratoModel
    $contratoModel = new ContratoModel();

    // Fetch contracts related to the report ID
// Controller
$contratos = $contratoModel->getContratosByReportId($id);

    // Load the Reportes model
    $reportesModel = new Reportes();

    // Fetch the report details by ID
    $reporte = $reportesModel->find($id);

    // Pass the contracts and report details data to the view
    return view("reporte/ver_contratos", [
        'contratos' => $contratos,
        'reporte' => $reporte
    ]);
}

public function finiquitos($id)
{
    // Load the FiniquitoModel
    $finiquitoModel = new finiquito_model();

    // Fetch finiquitos related to the report ID
    $finiquitos = $finiquitoModel->getFiniquitosByReportId($id);

    // Load the Reportes model
    $reportesModel = new Reportes();

    // Fetch the report details by ID
    $reporte = $reportesModel->find($id);

    // Pass the finiquitos and report details data to the view
    return view("reporte/ver_finiquito", [
        'finiquitos' => $finiquitos,
        'reporte' => $reporte
    ]);
}





    
    
    
    



    public function getDocumento()
    {
        try {
            $documentType = $this->request->getVar('type');
            $id = $this->request->getVar('id');
    
            // Validar y sanear datos de entrada
            $documentType = filter_var($documentType, FILTER_SANITIZE_STRING);
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            // Verificar si los datos son válidos
            if ($id === false || $id === null || empty($documentType)) {
                throw new InvalidArgumentException('Invalid input data');
            }
    
            // Obtener el modelo y buscar el reporte por ID
            $model = new Reportes();
            $report = $model->find($id);
    
            // Verificar si se encontró el reporte
            if ($report) {
                // Convertir el objeto $report a un array
                $reportArray = get_object_vars($report);
    
                // Verificar si el tipo de documento existe en el array
                if (array_key_exists($documentType, $reportArray)) {
                    $pdfName = $reportArray[$documentType];
    
                    // Devolver el nombre del archivo PDF
                    echo json_encode(['success' => true, 'pdfName' => $pdfName, 'reportId' => $report->Idreporte]);
                } else {
                    // Tipo de documento no encontrado
                    echo json_encode(['success' => false, 'message' => 'Document type not found for this report']);
                }
            } else {
                // Reporte no encontrado
                http_response_code(404); // Not Found
                echo json_encode(['success' => false, 'message' => 'Report not found']);
            }
        } catch (InvalidArgumentException $e) {
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
    
    
    
        public function subirPDF($id = null)
        {
            $model = new Reportes();
        
            if ($this->request->getMethod() === 'post') {
                // Validate form data as needed
                $id = (int) $this->request->getPost('id'); // Validate 'id' as an integer
        
                try {
                    // Validate uploaded files
                    $actaDeSeleccion = $this->request->getFile('acta_de_seleccion');
                    $informeExamenPsicologico = $this->request->getFile('informe_examen_psicologico');
                    $pdfCarnet = $this->request->getFile('pdfCarnet');
                    $certificadoAntecedentesPenales = $this->request->getFile('certificado_de_antecedentes_penales');
                    $certificadoNoViolencia = $this->request->getFile('certificado_de_no_violencia');
                    $curriculumVitae = $this->request->getFile('curriculum_vitae');
                    $memorandumAsignacionCargo = $this->request->getFile('memorandum_asignacion_del_cargo');
                    $pdfIngresoCaja = $this->request->getFile('pdfIngresoCaja');
                    $carnetAseguradoCPS = $this->request->getFile('carnet_de_asegurado_cps');
                    $formularioAporteSeguroLargoPlazo = $this->request->getFile('formulario_aporte_seguro_a_largo_plazo');
                    $formularioDesvinculacion = $this->request->getFile('formulario_de_desvinculacion');
                    $certificadoTrabajo = $this->request->getFile('certificado_trabajo');
        
                    // Check and process each file
                    $this->processFile($actaDeSeleccion, 'acta_de_seleccion', $id);
                    $this->processFile($informeExamenPsicologico, 'informe_examen_psicologico', $id);
                    $this->processFile($pdfCarnet, 'carnetescaneado', $id);
                    $this->processFile($certificadoAntecedentesPenales, 'certificado_de_antecedentes_penales', $id);
                    $this->processFile($certificadoNoViolencia, 'certificado_de_no_violencia', $id);
                    $this->processFile($curriculumVitae, 'curriculum_vitae', $id);
                    $this->processFile($memorandumAsignacionCargo, 'memorandum_asignacion_del_cargo', $id);
                    $this->processFile($pdfIngresoCaja, 'ingresocaja', $id);
                    $this->processFile($carnetAseguradoCPS, 'carnet_de_asegurado_cps', $id);
                    $this->processFile($formularioAporteSeguroLargoPlazo, 'formulario_aporte_seguro_a_largo_plazo', $id);
                    $this->processFile($formularioDesvinculacion, 'formulario_de_desvinculacion', $id);
                    $this->processFile($certificadoTrabajo, 'certificado_trabajo', $id);
        
                    // Redirect with success message
                    return redirect()->to('Reporte/subirpdf')->with('success', 'PDFs subidos exitosamente.');
        
                } catch (\Exception $e) {
                    // Log the exception
                    log_message('error', 'Exception: ' . $e->getMessage());
        
                    // Redirect with error message
                    return redirect()->to('Reporte/subirpdf')->with('error', 'Error al subir los PDFs.');
                }
            }
        
            // Cargar la relación con 'oficina'
            $data['reportes'] = $model
            ->join('dni_filiales', 'dni_filiales.id = reportes.oficina_id', 'left')
            ->select('reportes.*, dni_filiales.nombre_filial as nombre_oficina')
            ->orderBy('apellido', 'ASC')
            ->get()
            ->getResult();
        

        
            // Cargar el modelo de oficina para obtener la información de la oficina
            $oficinaModel = new Oficina();
            foreach ($data['reportes'] as $reporte) {
                $reporte->oficina = $oficinaModel->find($reporte->oficina_id);
            }
        
            $data['titulo'] = "Subir PDF";
        
            return view("reporte/subirpdf", $data);
        }
        
        // Helper method to process and move file
        protected function processFile($file, $fieldName, $id)
        {
            try {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/PDFs', $newName);
                    $model = new Reportes();
                    $model->update($id, [$fieldName => $newName]);
                }
            } catch (\Exception $e) {
                \config\Services::logger()->error("Error al procesar el archivo $fieldName: " . $e->getMessage());
                var_dump($e->getMessage());
            }
        }
        // Helper method to process and move file


        
    

public function formulariopdf($id)
{
    $model = new Reportes();
    $report = $model->find($id);
    $data['titulo'] = "Informacion";

    if ($report) {
        $data['report'] = $report;
    } else {
        $data['report'] = null;
    }

    $data['id'] = $id; // Aquí obtienes el Idreporte que se pasó en la URL
    return view("reporte/formulariopdf", $data);
}




public function vista_formulario_crear_reporte()
{
    // Obtén las oficinas desde el modelo
    $oficinas = $this->oficinaModel->findAll(); // Ajusta según la lógica de tu modelo

    // Pasa las oficinas a la vista
    $data['oficinas'] = $oficinas;


    // ... (código existente)

    // Carga la vista del formulario con las oficinas
    return view("reporte/crear_reporte", $data);

}


  // In your controller
  public function guardar_reporte()
{
    // Validación de formulario (ajusta según tus necesidades)
    $validationRules = [
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'apellido_materno' =>  'permit_empty',
        'Ci' => 'required',
        'nua' => 'required',
        'fechaingreso' => 'required',
        'fecharetiro' => 'permit_empty|valid_date[Y-m-d]', // Permitir que la fecha de retiro sea opcional
        'ubicacion' => 'required',
        'genero' => 'required',
        'cargo' => 'required',
        'proyecto' => 'required',
        'motivo_conclusion' => 'permit_empty', // Permitir que el motivo de conclusión sea opcional
        'oficina' => 'required|integer', // Validar que el valor de la oficina sea un entero
        // Agrega las reglas de validación para otros campos según sea necesario
    ];

    // Realiza la validación
    if (!$this->validate($validationRules)) {
        // Si la validación falla, redirige de nuevo al formulario con los errores
        return redirect()->to(base_url('Reporte/vista_formulario_crear_reporte'))->withInput()->with('errors', $this->validator->getErrors());
    }

    // Datos del formulario validados
    $fecharetiro = $this->request->getPost('fecharetiro');

    // Ajusta el valor de fecharetiro para manejar '0000-00-00' cuando no se proporciona fecha
    $fecharetiro = !empty($fecharetiro) ? date('Y-m-d', strtotime($fecharetiro)) : '0000-00-00';

    // Obtén el ID de la oficina seleccionada desde el formulario
    $idOficina = $this->request->getPost('oficina');

    // Añade el ID de la oficina a los datos del reporte
    $reporteData = [
        'nombre' => $this->request->getPost('nombre'),
        'apellido' => $this->request->getPost('apellido_paterno'),
        'apellido_materno' => $this->request->getPost('apellido_materno'),
        'Ci' => $this->request->getPost('Ci'),
        'nua' => $this->request->getPost('nua'),
        'fechaingreso' => date('Y-m-d', strtotime($this->request->getPost('fechaingreso'))),
        'fechafin' => $fecharetiro, // Usa el nombre correcto de la columna en la base de datos
        'ubicacion' => $this->request->getPost('ubicacion'),
        'genero' => $this->request->getPost('genero'),
        'cargo' => $this->request->getPost('cargo'),
        'proyecto' => $this->request->getPost('proyecto'),
        'motivo_conclusion' => $this->request->getPost('motivo_conclusion'),
        'oficina_id' => $idOficina, // Agrega el ID de la oficina
        // Agrega otros campos según sea necesario
    ];

    try {
        // Intenta insertar el nuevo reporte en la base de datos
        $this->reportesModel->insert($reporteData);

        // Establece un mensaje de éxito en la sesión
        $this->session->setFlashdata('success_message', 'Reporte creado exitosamente');

        // Redirige a la vista del formulario con el mensaje de éxito
        return redirect()->to(base_url('Reporte/vista_formulario_crear_reporte'));
    } catch (\Exception $e) {
        // Manejo de errores
        log_message('error', 'Error al crear el reporte: ' . $e->getMessage());

        // Establece un mensaje de error en la sesión
        $this->session->setFlashdata('error_message', 'Error al crear el reporte. Por favor, inténtalo de nuevo.');

        // Redirige a la vista del formulario con el mensaje de error
        return redirect()->to(base_url('Reporte/vista_formulario_crear_reporte'));
    }
}

    
    
    public function editar_reporte()
    {
        
    
        $model = new Reportes();
        
        $data['reportes'] = $model->orderBy('apellido', 'ASC')->findAll();
        
        $data['titulo']="Lista editar";
        
        
        return view("reporte/lista_editar", $data);
    }
    
   // public function formulario_editar_reporte($id_reporte)
public function formulario_editar_reporte($id_reporte)
{
    $model = new Reportes();
    $reporte = $model->find($id_reporte);

    // Obtén las oficinas desde el modelo
    $oficinaModel = new oficina(); // Reemplaza con el nombre real de tu modelo
    $oficinas = $oficinaModel->findAll(); // Ajusta según la lógica de tu modelo

    // Pasa las oficinas a la vista
    $data['oficinas'] = $oficinas;

    // Verifica si el reporte existe
    if ($reporte) {
        $data['titulo'] = "Editar Reporte";
        $data['reporte'] = $reporte;

        return view("reporte/editar_reporte", $data);
    } else {
        // Manejar el caso donde el reporte no existe
        return redirect()->to(base_url('Reporte/listar_reportes'))->with('error_message', 'No se encontró el reporte.');
    }
}

public function guardar_edicion()
{
    $model = new Reportes();

    // Validar y sanitizar datos del formulario
    $id_reporte = $this->request->getPost('id_reporte');
    $nombre = $this->request->getPost('nombre');
    $apellido_paterno = $this->request->getPost('apellido_paterno');
    $apellido_materno = $this->request->getPost('apellido_materno');
    $ci = $this->request->getPost('Ci');
    $nua = $this->request->getPost('nua');
    $genero = $this->request->getPost('genero');
    $fechaingreso = $this->request->getPost('fechaingreso');
    $cargo = $this->request->getPost('cargo');
    $oficina = $this->request->getPost('oficina');
    $proyecto = $this->request->getPost('proyecto');
    $fecharetiro = $this->request->getPost('fecharetiro');
    $motivo_conclusion = $this->request->getPost('motivo_conclusion');
    $ubicacion = $this->request->getPost('ubicacion');

    // Realizar validaciones adicionales si es necesario
    // ...

    // Iniciar transacción
    $model->transStart();

    try {
        // Actualizar el reporte en la base de datos
        $model->update($id_reporte, [
            'nombre' => $nombre,
            'apellido' => $apellido_paterno,
            'apellido_materno' => $apellido_materno,
            'Ci' => $ci,
            'nua' => $nua,
            'genero' => $genero,
            'fechaingreso' => $fechaingreso,
            'cargo' => $cargo,
            'oficina_id' => $oficina,
            'proyecto' => $proyecto,
            'fechafin' => $fecharetiro,
            'motivo_conclusion' => $motivo_conclusion,
            'ubicacion' => $ubicacion,
        ]);

        // Confirmar la transacción
        $model->transComplete();

        // Redireccionar con un mensaje de éxito
        return redirect()->to(base_url('Reporte/index'))->with('success_message', 'Reporte actualizado con éxito.');
    } catch (\Exception $e) {
        // Si hay un error, revertir la transacción
        $model->transRollback();

        // Redireccionar con un mensaje de error
        return redirect()->back()->withInput()->with('error_message', 'Error al actualizar el reporte: ' . $e->getMessage());
    }
}

    


    
}