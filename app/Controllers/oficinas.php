<?php

namespace App\Controllers;

use App\Models\oficina;
use App\Models\usuario;



class oficinas extends BaseController
{
    
    public function vista_oficinas_filial_crear()
    {
        $data['titulo'] = "Crear filial";   
        return view("filiales/crear_filial", $data);
    }

    public function crearFilial()
       {
    if ($this->request->getMethod() === 'post') {
        // Obtener datos del formulario
        $nombreFilial = $this->request->getPost('nombre_filial');
        $idUsuario = session('Idusuario'); // Obtener el ID del usuario de la sesión

        // Crear instancia del modelo Oficina
        $modelOficina = new \App\Models\Oficina();

        // Crear la filial
        if ($modelOficina->crearFilial($nombreFilial, $idUsuario)) {
            // Filial creada con éxito
            session()->setFlashdata('success_message', 'Filial creada con éxito');
            return redirect()->to(base_url('oficinas/vista_oficinas_filial_crear'));
        } else {
            // Error al crear la filial
            session()->setFlashdata('error_message', 'Error al crear la filial');
            return redirect()->back();
        }
    }
        }

        // En tu controlador
// En tu controlador
public function listarOficinas()
{
    $modelOficina = new \App\Models\Oficina();

    // Obtén las oficinas con la relación 'usuario' cargada
    $data['oficinas'] = $modelOficina
        ->select('dni_filiales.*, usuario.nombre, usuario.apellido')
        ->join('usuario', 'dni_filiales.id_usuario = usuario.Idusuario', 'left')
        ->findAll();

    // Carga la vista
    return view('filiales/lista_filiales', $data);
}// Controlador
public function formulario_editar_oficina($id_oficina)
{
    // Obtén la información actual de la oficina
    $oficinaModel = new \App\Models\Oficina();
    $oficina = $oficinaModel->find($id_oficina);

    // Verifica si la oficina existe
    if (!$oficina) {
        // Manejar el caso en que la oficina no existe
        return redirect()->to('ruta_de_redireccion');  // Reemplaza 'ruta_de_redireccion' con la URL adecuada
    }

    // Verifica si se está enviando el formulario
    if ($this->request->getMethod() === 'post') {
        // Realiza la validación y actualización de datos
        $nuevoNombre = $this->request->getPost('nombre_nuevo_oficina');

        // Actualiza la información en la base de datos
        $oficinaModel->update($id_oficina, [
            'nombre_filial' => $nuevoNombre,
            'fecha_modificacion' => date('Y-m-d H:i:s'),  // Agrega la fecha y hora actual
        ]);

        // Redirige a la página de listado de oficinas
        return redirect()->to(base_url('oficinas/listarOficinas'));

    }

    // Pasa los datos a la vista
    $data['titulo'] = "Editar oficina";
    $data['oficina'] = $oficina;

    return view("filiales/formulario_de_modificacion", $data);
}






}