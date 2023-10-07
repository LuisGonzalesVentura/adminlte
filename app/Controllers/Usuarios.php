<?php 

namespace App\Controllers;
use App\Models\Usuario;
class Usuarios extends BaseController
{

    private $usuario;
    private function index()
    {
        $data['titulo']="Modulo de Usuarios";
        return view("Usuarios/index", $data);
    }
}