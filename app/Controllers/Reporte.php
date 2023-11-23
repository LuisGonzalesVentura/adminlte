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
        $report = $model->find($id);
        $data['titulo']="Informacion";


        if ($report) {
            $data['report'] = $report;
        } else {
            $data['report'] = null;
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

        $model = new Reportes();
        $report = $model->find($id);

        if ($report) {
            $pdfName = $report[$documentType];

            log_message('info', 'Document Type: ' . $documentType);
            log_message('info', 'Report ID: ' . $id);

            // Leer el contenido del PDF
            $pdfContent = file_get_contents(ROOTPATH . 'public/PDFs/' . $pdfName);

            // Devolver el contenido del PDF como base64
            echo json_encode(['success' => true, 'pdfData' => base64_encode($pdfContent)]);
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
    
            try {
                // Validate uploaded file
                $pdfUsuario = $this->request->getFile('pdfUsuario');
                if ($pdfUsuario->isValid() && !$pdfUsuario->hasMoved()) {
                    // Cambia el directorio de destino a public/PDFs/
                    $newName = $pdfUsuario->getRandomName();
                    $pdfUsuario->move(ROOTPATH . 'public/PDFs', $newName);
    
                    // Update the database with the file name
                    // Solo guardamos el nombre del archivo, no la ruta completa
                    $model->update($id, ['carnetescaneado' => $newName]);
    
                    // Log the file name
                    log_message('info', 'File Name: ' . $newName);
    
                    // Redirect with success message
                    return redirect()->to('Reporte/subirpdf')->with('success', 'PDF subido exitosamente.');
                } else {
                    // Log the error
                    log_message('error', 'Error al subir el PDF: ' . $pdfUsuario->getErrorString());
                    // Redirect with error message
                    return redirect()->to('Reporte/subirpdf')->with('error', 'Error al subir el PDF. ' . $pdfUsuario->getErrorString());
                }
    
            } catch (\Exception $e) {
                // Log the exception
                log_message('error', 'Exception: ' . $e->getMessage());
    
                // Redirect with error message
                return redirect()->to('Reporte/subirpdf')->with('error', 'Error al subir el PDF.');
            }
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