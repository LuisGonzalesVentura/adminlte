<?php

namespace App\Controllers;

use App\Models\TipoContrato;
use App\Models\usuario;



class tipocontratos extends BaseController
{
    
    public function vista_Contrato_crear()
    {
        $data['titulo'] = "Crear contrato";   
        return view("tipo_contrato/crear_tipo_contrato", $data);
    }
    public function crearContrato()
    {
        if ($this->request->getMethod() === 'post') {
            // Obtener datos del formulario
            $nombreContrato = $this->request->getPost('nombre_contrato');
            $idUsuario = session('Idusuario'); // Obtener el ID del usuario de la sesión
    
            // Crear instancia del modelo TipoContrato
            $modelContrato = new \App\Models\TipoContrato();
    
            // Crear el contrato
            if ($modelContrato->crearContrato($nombreContrato, $idUsuario)) {
                // Contrato creado con éxito
                session()->setFlashdata('success_message', 'Contrato creado con éxito');
                return redirect()->to(base_url('tipocontratos/vista_Contrato_crear'));
            } else {
                // Error al crear el contrato
                session()->setFlashdata('error_message', 'Error al crear el contrato');
                return redirect()->back();
            }
        }
    }
    
    public function listar_contratos()
    {
        $modelContrato = new \App\Models\TipoContrato();
    
        // Obtén los contratos con la relación 'usuario' cargada
        $data['contratos'] = $modelContrato
            ->select('tipo_contrato.*, usuario.nombre, usuario.apellido')
            ->join('usuario', 'tipo_contrato.usuario_id = usuario.Idusuario', 'left')
            ->findAll();
    
        // Carga la vista
        return view('tipo_contrato/lista_contratos', $data);


    }
    public function formulario_editar_contrato($id_contrato)
{
    // Obtén la información actual del contrato
    $contratoModel = new \App\Models\TipoContrato();
    $contrato = $contratoModel->find($id_contrato);

    // Verifica si el contrato existe
    if (!$contrato) {
        // Maneja el caso en que el contrato no existe
        return redirect()->to('ruta_de_redireccion');  // Reemplaza 'ruta_de_redireccion' con la URL adecuada
    }

    // Verifica si se está enviando el formulario
    if ($this->request->getMethod() === 'post') {
        // Realiza la validación y actualización de datos
        $nuevoNombre = $this->request->getPost('nombre_nuevo_contrato');

        // Actualiza la información en la base de datos
        $contratoModel->update($id_contrato, [
            'tipo_contrato' => $nuevoNombre,
            'fecha_modificacion' => date('Y-m-d H:i:s'),  // Agrega la fecha y hora actual
        ]);

        // Redirige a la página de listado de contratos
        return redirect()->to(base_url('tipocontratos/listar_contratos'));

    }

    // Pasa los datos a la vista
    $data['titulo'] = "Editar contrato";
    $data['contrato'] = $contrato;

    return view("tipo_contrato/Formulario_edicion_contrato", $data);
}

}