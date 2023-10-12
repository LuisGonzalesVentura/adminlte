<?php 

namespace App\Controllers;
use App\Models\Usuario;
class listaeditarusuarios extends BaseController
{

    private $usuario;
    public function index()
    {
        $this->usuario=new Usuario();
        $data['usuarios']=$this->usuario->orderBy('Idusuario','ASC')->findAll();

        $data['titulo']="Lista de editar usuarios";
        
        return view("Usuarios/listaeditarusuarios", $data);
    }
}