<?php 

namespace App\Controllers;
use App\Models\Reportes;
class Reporte extends BaseController
{

    public function index()
    {
        
        $model = new Reportes();
        
        $data['reportes'] = $model->orderBy('Idreporte', 'ASC')->findAll();
        
        $data['titulo']="Lista reporte";
        
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
    

   
    
    public function documentos()
    {
        $model = new Reportes();
        $data['reportes'] = $model->orderBy('Idreporte', 'ASC')->findAll();  // Asegúrate de que estás recuperando los reportes de alguna manera
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
    
        $data['reportes'] = $model->orderBy('Idreporte', 'ASC')->findAll();
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



}