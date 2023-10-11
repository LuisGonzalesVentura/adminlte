<?php 

namespace App\Controllers;
use App\Models\Usuario;
class DesactivarUsuario extends BaseController
{

    private $usuario;
    public function desactivarusuario()
    {
        $data['titulo']="Desactivar usuario";
        return view("Usuarios/desactivarusuario", $data);
    }
}