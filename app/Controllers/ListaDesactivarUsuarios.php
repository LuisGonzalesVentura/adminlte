<?php 

namespace App\Controllers;
use App\Models\Usuario;
class listadesactivarusuarios extends BaseController
{

    private $usuario;
    public function index()
    {
        $this->usuario=new Usuario();
        $data['usuarios']=$this->usuario->orderBy('Idusuario','ASC')->findAll();

        $data['titulo']="Lista de editar usuarios";
        
        return view("Usuarios/listadesactivarusuarios", $data);
    }
    public function desactivar($IdUsuario=null){
        $this->usuario=new Usuario();
        $datosusuario = $this->usuario->where('Idusuario', $IdUsuario)->first();
        if($datosusuario['estado']=='Activo'){
            $datos = ['estado' => 'Inactivo'];
        }
        else{
            $datos = ['estado' => 'Activo'];
        }
        $this->usuario->protect(false);
        $this->usuario->update($IdUsuario, $datos);
        return $this->response->redirect("http://localhost/adminlte/public/listadesactivarusuarios");    
    }
}