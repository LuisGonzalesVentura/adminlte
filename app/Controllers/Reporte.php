<?php 

namespace App\Controllers;
use App\Models\Reportes;
class Reporte extends BaseController
{

    protected $reportesModel;

    public function __construct()
    {
        // Carga el modelo en el constructor
        $this->reportesModel = new Reportes();
    }

    public function index()
    {
        $model = new Reportes();
        $data['reportes'] = $model->orderBy('apellido', 'ASC')->findAll();
        $data['titulo'] = "Lista reporte";
        return view("reporte/index", $data);
    }
    

 
    public function ver($id)
    {
        $model = new Reportes();
        $reporte = $model->find($id);
        $data['titulo'] = "Informacion";
    
        if ($reporte) {
            $data['reporte'] = $reporte; // Cambiado de $report a $reporte
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
        public function getDocumento()
        {
            try {
                $documentType = $this->request->getVar('type');
                $id = $this->request->getVar('id');
        
                // Validar y sanear datos de entrada
                $documentType = filter_var($documentType, FILTER_SANITIZE_STRING);
                $id = filter_var($id, FILTER_VALIDATE_INT);
        
                if ($id === false || $id === null) {
                    throw new InvalidArgumentException('Invalid report ID');
                }
        
                $model = new Reportes();
                $report = $model->find($id);
        
                if ($report) {
                    log_message('info', 'Report Array: ' . print_r($report, true));
                    log_message('info', 'Document Type: ' . $documentType);
        
                    if (array_key_exists($documentType, $report)) {
                        $pdfName = $report[$documentType];
        
                        // Leer el contenido del PDF
                        $pdfContent = file_get_contents(ROOTPATH . 'public/PDFs/' . $pdfName);
        
                        // Devolver el contenido del PDF como base64
                        echo json_encode(['success' => true, 'pdfData' => base64_encode($pdfContent), 'reportId' => $report['Idreporte']]);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Document type not found for this report']);
                    }
                } else {
                    http_response_code(404); // Not Found
                    echo json_encode(['success' => false, 'message' => 'Report not found']);
                }
            } catch (\Exception $e) {
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
    
          // ...

// ...

try {
    // Validate uploaded files
    $pdfCarnet = $this->request->getFile('pdfCarnet');
    $pdfIngresoCaja = $this->request->getFile('pdfIngresoCaja');
    $pdfContrato1 = $this->request->getFile('pdfContrato1');
    $pdfFiniquito1 = $this->request->getFile('pdfFiniquito1');
    $pdfRetiroCaja = $this->request->getFile('pdfRetiroCaja');

    // Check if "carnet escaneado" file is valid
    if ($pdfCarnet->isValid() && !$pdfCarnet->hasMoved()) {
        $newNameCarnet = $pdfCarnet->getRandomName();
        $pdfCarnet->move(ROOTPATH . 'public/PDFs', $newNameCarnet);
        $model->update($id, ['carnetescaneado' => $newNameCarnet]);
    }

    // Check if "ingreso caja" file is valid
    if ($pdfIngresoCaja->isValid() && !$pdfIngresoCaja->hasMoved()) {
        $newNameIngresoCaja = $pdfIngresoCaja->getRandomName();
        $pdfIngresoCaja->move(ROOTPATH . 'public/PDFs', $newNameIngresoCaja);
        $model->update($id, ['ingresocaja' => $newNameIngresoCaja]);
    }

    // Check if "contrato1" file is valid
    if ($pdfContrato1->isValid() && !$pdfContrato1->hasMoved()) {
        $newNameContrato1 = $pdfContrato1->getRandomName();
        $pdfContrato1->move(ROOTPATH . 'public/PDFs', $newNameContrato1);
        $model->update($id, ['contrato1' => $newNameContrato1]);
    }

    // Check if "finiquito1" file is valid
    if ($pdfFiniquito1->isValid() && !$pdfFiniquito1->hasMoved()) {
        $newNameFiniquito1 = $pdfFiniquito1->getRandomName();
        $pdfFiniquito1->move(ROOTPATH . 'public/PDFs', $newNameFiniquito1);
        $model->update($id, ['finiquito1' => $newNameFiniquito1]);
    }

    // Check if "retirocaja" file is valid
    if ($pdfRetiroCaja->isValid() && !$pdfRetiroCaja->hasMoved()) {
        $newNameRetiroCaja = $pdfRetiroCaja->getRandomName();
        $pdfRetiroCaja->move(ROOTPATH . 'public/PDFs', $newNameRetiroCaja);
        $model->update($id, ['retirocaja' => $newNameRetiroCaja]);
    }

    // Log the file names
    log_message('info', 'Carnet Escaneado File Name: ' . $newNameCarnet);
    log_message('info', 'Ingreso Caja File Name: ' . $newNameIngresoCaja);
    log_message('info', 'Contrato1 File Name: ' . $newNameContrato1);
    log_message('info', 'Finiquito1 File Name: ' . $newNameFiniquito1);
    log_message('info', 'Retiro Caja File Name: ' . $newNameRetiroCaja);

    // Redirect with success message
    return redirect()->to('Reporte/subirpdf')->with('success', 'PDFs subidos exitosamente.');

} catch (\Exception $e) {
    // Log the exception
    log_message('error', 'Exception: ' . $e->getMessage());

    // Redirect with error message
    return redirect()->to('Reporte/subirpdf')->with('error', 'Error al subir los PDFs.');
}

// ...


// ...

        }
    
        $data['reportes'] = $model->orderBy('apellido', 'ASC')->findAll();
        $data['titulo'] = "Subir PDF";
    
        return view("reporte/subirpdf", $data);
    }
    
    

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
        
    
        
        $data['titulo']="Crear reporte";
        
        return view("reporte/crear_reporte", $data);
    }

    public function guardar_reporte()
    {
        // Validación de formulario (ajusta según tus necesidades)
        $validationRules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'nua' => 'required',
            'Ci' => 'required',
            'fechanacimiento' => 'required',
            'fechaingreso' => 'required',
            'fechafin' => 'permit_empty|valid_date[Y-m-d]', // Cambiado para permitir vacío y validar formato
            'ubicacion' => 'required', // Cambiado para reflejar el nombre del campo en la base de datos
            // Agrega las reglas de validación para otros campos según sea necesario
        ];
    
        // Realiza la validación
        if (!$this->validate($validationRules)) {
            // Si la validación falla, redirige de nuevo al formulario con los errores
            return redirect()->to(base_url('Reporte/vista_formulario_crear_reporte'))->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Datos del formulario validados
        $fechafin = $this->request->getPost('fechafin');
    
        // Verifica si se proporcionó una fecha de retiro
        if (empty($fechafin)) {
            // Si no se proporcionó una fecha de retiro, establece "0000-00-00"
            $fechafin = '0000-00-00';
        } else {
            // Si se proporcionó una fecha de retiro, conviértela al formato deseado
            $fechafin = date('Y-m-d', strtotime($fechafin));
        }
    
        $reporteData = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'nua' => $this->request->getPost('nua'),
            'Ci' => $this->request->getPost('Ci'),
            'fechanacimiento' => date('Y-m-d', strtotime($this->request->getPost('fechanacimiento'))),
            'fechaingreso' => date('Y-m-d', strtotime($this->request->getPost('fechaingreso'))),
            'fechafin' => $fechafin,
            'ubicacion' => $this->request->getPost('ubicacion'), // Cambiado para reflejar el nombre del campo en la base de datos
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
    
    public function formulario_editar_reporte($id_reporte)
{
    $model = new Reportes();
    $reporte = $model->find($id_reporte);

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
        $apellido = $this->request->getPost('apellido');
        $Ci = $this->request->getPost('Ci');
        $nua = $this->request->getPost('nua');
        $fechanacimiento = $this->request->getPost('fechanacimiento');
        $fechaingreso = $this->request->getPost('fechaingreso');
        $fechafin = $this->request->getPost('fechafin');
        $ubicacion = $this->request->getPost('ubicacion');

        // Realizar validaciones adicionales si es necesario

        // Actualizar el reporte en la base de datos
        $model->update($id_reporte, [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'Ci' => $Ci,
            'nua' => $nua,
            'fechanacimiento' => $fechanacimiento,
            'fechaingreso' => $fechaingreso,
            'fechafin' => $fechafin,
            'ubicacion' => $ubicacion,

        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->to(base_url('Reporte/editar_reporte'));
    }


    
}