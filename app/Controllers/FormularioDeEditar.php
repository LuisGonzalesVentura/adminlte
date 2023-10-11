<?php 

namespace App\Controllers;
use App\Models\Usuario;
class formularioDeEditar extends BaseController
{

    private $usuario;
    public function formulariodeeditar()
    {
        $data['titulo']="Formulario Editar";
        return view("Usuarios/formulariodeeditar", $data);
    }
}