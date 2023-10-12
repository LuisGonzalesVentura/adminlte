<?php 

namespace App\Controllers;
use App\Models\Usuario;
class formularioDeEditar extends BaseController
{

    private $usuario;
    public function index()
    {
        $data['titulo']="Formulario Editar";
        return view("Usuarios/formulariodeeditar", $data);
    }
    public function editar($id=null){
   
        $this->usuario=new Usuario();
        $data['usuario']=$this->usuario->orderBy('Idusuario','ASC')->findAll($id);
        //session()->set($data); 
        
        $data['titulo']="Formulario Editar";
        
        return view("Usuarios/formulariodeeditar", $data);
    }
}