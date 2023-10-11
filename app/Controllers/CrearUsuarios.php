<?php 

namespace App\Controllers;
use App\Models\Usuario;
class CrearUsuarios extends BaseController
{

    private $usuario;
    public function crearusuario()
    {
        $data['titulo']="Crear Usuarios";
        return view("Usuarios/crearusuario", $data);
    }
}