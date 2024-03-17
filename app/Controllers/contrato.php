<?php

namespace App\Controllers;

use App\Models\ContratoModel; // Corregir el modelo a utilizar
use App\Models\TipoContrato;
use App\Models\Usuario; // Importar el modelo de Usuario
use App\Models\Reportes;
use App\Models\registroconsultoria_n;



class contrato extends BaseController
{
    
    public function vista_Contrato_subir_pdf_formulario()
    {
        // Obtener los tipos de contrato desde el modelo
        $tipoContratoModel = new TipoContrato();
        $data['tipos_contrato'] = $tipoContratoModel->findAll();

        $reportesModel = new Reportes();
        $data['empleados'] = $reportesModel->findAll();

        

        // Cargar la vista con los tipos de contrato
        $data['titulo'] = "Subir contrato";
        return view("contratos/formulario_subir_contrato", $data);

        

    }

    public function crearContrato()
    {
        // Verificar si se están enviando datos del formulario
        if ($this->request->getMethod() === 'post') {
            // Recibir los datos del formulario
          // Recibir los datos del formulario
$id_empleado = $this->request->getPost('id_empleado_c');
$tipo_contrato = $this->request->getPost('tipo_contrato');
$fecha_inicio = $this->request->getPost('fecha_de_inicio');
$fecha_finalizacion = $this->request->getPost('fecha_de_finalizacion');
$archivo = $this->request->getFile('ruta_documentacion_pdf');

// // Obtener el CI del empleado
$reportesModel = new Reportes();
$empleadoReportes = $reportesModel->find($id_empleado);

$registroconsultoriaModel = new registroconsultoria_n();
$empleadoConsultoria = $registroconsultoriaModel->find($id_empleado);

// Verificar si el empleado existe
if (!$empleadoReportes && !$empleadoConsultoria) {
    // Mostrar un mensaje de error o redirigir a una página de error
    return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'El empleado seleccionado no existe.');
}

$ci_empleado = ($empleadoReportes) ? $empleadoReportes->Ci : $empleadoConsultoria->carnet_identidad_n;



// Generar el nombre del archivo
$nuevoNombreArchivo = $ci_empleado . '_' . date('Ymd_His') . '.pdf';
 // Ruta de destino para guardar los archivos PDF de contratos
 $ruta_destino = FCPATH . 'pdfscontratos' . DIRECTORY_SEPARATOR;

// Mover el archivo al directorio de destino
try {
    $archivo->move($ruta_destino, $nuevoNombreArchivo);
} catch (\Exception $e) {
    // Manejar el error si falla la transferencia del archivo
    echo 'Error al mover el archivo: ' . $e->getMessage();
    die();  // Detener la ejecución para ver el mensaje de error
}


// Ahora que el archivo está en la ubicación deseada, puedes guardar los datos en la base de datos
// ...


    
            //  Guardar los datos en la base de datos
            $contratoModel = new ContratoModel(); // Corregido: Utilizar ContratoModel
            $data = [
                'id_empleado_c' => $id_empleado,
                'archivo_c' => $nuevoNombreArchivo,
                'tipo_contrato_c' => $tipo_contrato,
                'fecha_inicio_contrato_c' => $fecha_inicio,
                'fecha_finalizacion_contrato_c' => $fecha_finalizacion,
                'usuario_creator_c' => session()->get('Idusuario'), // Obtener el ID del usuario actual de tu sesión
                'fecha_creacion_c' => date('Y-m-d'),
                'fecha_modificacion_c' => '0000-00-00' // Establecer la fecha de modificación
            ];
    
            // Intentar insertar los datos y capturar cualquier error que ocurra
            try {
                $contratoModel->insert($data);
                // Redirigir a una página de éxito o mostrar un mensaje de éxito
                session()->setFlashdata('success_message', 'Contrato creado con éxito');

                return redirect()->to(base_url('contrato/vista_Contrato_subir_pdf_formulario'));

                     

            } catch (\Exception $e) {
                // Mostrar el mensaje de error o redirigir a una página de error
                return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al crear el contrato: ' . $e->getMessage());
            }
        }
    
        // Si no hay datos del formulario, redirigir a alguna página
        return redirect()->to('ruta_por_defecto');
    }
  // Controlador
  public function listarContratos()
{
    // Obtener todos los contratos desde el modelo
    $contratoModel = new ContratoModel();
    $contratos = $contratoModel
        ->select('contratos.*, usuario.nombre as nombre_usuario, usuario.apellido as apellido_usuario')
        ->join('usuario', 'contratos.usuario_creator_c = usuario.Idusuario', 'left')
        ->findAll();

    $reportesModel = new Reportes();
    $usuarioModel = new Usuario();

    foreach ($contratos as &$contrato) {
        // Obtenemos los detalles del trabajador correspondiente al ID de empleado
        $trabajador = $reportesModel->find($contrato['id_empleado_c']);

        // Si encontramos el trabajador, asignamos su nombre completo al contrato
        if ($trabajador) {
            $nombreCompleto = $trabajador->nombre . ' ' . $trabajador->apellido . ' ' . $trabajador->apellido_materno;
            $contrato['nombre_trabajador'] = $nombreCompleto;
            
            // Agregar el CI del empleado a los datos del contrato
            $contrato['ci_empleado'] = $trabajador->Ci;
        } else {
            $contrato['nombre_trabajador'] = 'Desconocido';
            $contrato['ci_empleado'] = 'N/A';
        }

        // Obtenemos el nombre del tipo de contrato
        $tipoContratoModel = new TipoContrato();
        $tipoContrato = $tipoContratoModel->find($contrato['tipo_contrato_c']);
        $contrato['tipo_contrato_c'] = $tipoContrato ? $tipoContrato->tipo_contrato : 'Desconocido';

        // Obtener el nombre del usuario creador
        $usuarioCreador = $usuarioModel->find($contrato['usuario_creator_c']);
        if ($usuarioCreador) {
            $contrato['nombre_usuario'] = isset($usuarioCreador['nombre']) ? $usuarioCreador['nombre'] : 'Desconocido';
            $contrato['apellido_usuario'] = isset($usuarioCreador['apellido']) ? $usuarioCreador['apellido'] : 'Desconocido';
        } else {
            $contrato['nombre_usuario'] = 'Desconocido';
            $contrato['apellido_usuario'] = 'Desconocido';
        }
    }
    unset($contrato);

    // Pasamos los datos actualizados a la vista
    $data['contratos'] = $contratos;
    $data['titulo'] = "Listado de contratos";
    return view("contratos/lista_contratos", $data);
}

  public function editarContrato($idContrato)
  {
      // Verificar si se están enviando datos del formulario
      if ($this->request->getMethod() === 'post') {
          // Recibir los datos del formulario
          $fechaInicio = $this->request->getPost('fecha_de_inicio');
          $fechaFinalizacion = $this->request->getPost('fecha_de_finalizacion');
          $nuevoArchivo = $this->request->getFile('nuevo_archivo');
  
          // Obtener la información del contrato por su ID
          $contratoModel = new ContratoModel();
          $contrato = $contratoModel->find($idContrato);
  
          // Verificar si el contrato existe
          if (!$contrato) {
              // Puedes manejar el caso en el que el contrato no exista, por ejemplo, redirigiendo a una página de error
              return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Contrato no encontrado');
          }
  
          // Obtener el CI del empleado asociado al contrato
          $reportesModel = new Reportes();
          $empleado = $reportesModel->find($contrato['id_empleado_c']);
          $ci_empleado = $empleado ? $empleado->Ci : '';
  
          // Verificar si se proporciona un nuevo archivo y si es válido
          if ($nuevoArchivo && $nuevoArchivo->isValid() && !$nuevoArchivo->hasMoved()) {
              // Generar el nuevo nombre del archivo
              $nuevoNombreArchivo = $ci_empleado . '_' . date('YmdHis') . '.pdf';
  
              // Ruta de destino para guardar los archivos PDF de contratos
              $ruta_destino = FCPATH . 'pdfscontratos' . DIRECTORY_SEPARATOR;
  
              // Mover el nuevo archivo al directorio de destino
              try {
                  $nuevoArchivo->move($ruta_destino, $nuevoNombreArchivo);
  
                  // Actualizar los datos en la base de datos, incluyendo el nuevo nombre del archivo
                  $data = [
                      'fecha_inicio_contrato_c' => $fechaInicio,
                      'fecha_finalizacion_contrato_c' => $fechaFinalizacion,
                      'archivo_c' => $nuevoNombreArchivo,
                      'fecha_modificacion_c' => date('Y-m-d H:i:s', time()), // Utilizar la fecha actual como fecha de modificación
                  ];
  
                  // Utiliza el método update para actualizar el registro
                  $contratoModel->update($idContrato, $data);
  
              } catch (\Exception $e) {
                  // Mostrar el mensaje de error o redirigir a una página de error
                  return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Error al mover el archivo: ' . $e->getMessage());
              }
          } else {
              // Si no se proporciona un nuevo archivo, actualizar solo las fechas y mantener el nombre del archivo existente
              $data = [
                  'fecha_inicio_contrato_c' => $fechaInicio,
                  'fecha_finalizacion_contrato_c' => $fechaFinalizacion,
                  'fecha_modificacion_c' => date('Y-m-d H:i:s', time()), // Utilizar la fecha actual como fecha de modificación
              ];
  
              // Utiliza el método update para actualizar el registro
              $contratoModel->update($idContrato, $data);
          }
  
          // Redirigir a una página de éxito o mostrar un mensaje de éxito
          session()->setFlashdata('success_message', 'Contrato actualizado con éxito');
          return redirect()->to(base_url('contrato/vista_Contrato_subir_pdf_formulario'));
      }
  
      // Si no hay datos del formulario, redirigir a alguna página
      return redirect()->to('ruta_por_defecto');
  }
  


  
 // En tu controlador
public function vista_formulario_edicion_contrato($idContrato)
{
    // Cargar el modelo de Contrato
    $contratoModel = new ContratoModel();

    // Obtener la información del contrato por su ID
    $contrato = $contratoModel->find($idContrato);

    // Verificar si el contrato existe
    if (!$contrato) {
        // Puedes manejar el caso en el que el contrato no exista, por ejemplo, redirigiendo a una página de error
        return redirect()->to('ruta_de_la_pagina_de_error')->with('error_message', 'Contrato no encontrado');
    }

    // Pasar la información del contrato a la vista
    $data['titulo'] = "Edición de contrato";
    $data['contrato'] = $contrato;

    // Cargar la vista con los datos del contrato
    return view("contratos/formulario_edicion_contrato", $data);
}



}