<?php 

namespace App\Controllers;
use App\Models\Usuario;
class EliminarUsuarios extends BaseController
{

    private $usuario;
    public function eliminarusuario()
    {
        $data['titulo']="Eliminar Usuarios";
        return view("Usuarios/eliminarusuario", $data);
    }
}