<?php 

namespace App\Controllers;
use App\Models\Usuario;
class listaborrarusuarios extends BaseController
{

    private $usuario;
    public function index()
    {
        $this->usuario=new Usuario();
        $data['usuarios']=$this->usuario->orderBy('Idusuario','ASC')->findAll();

        $data['titulo']="Lista de editar usuarios";
        
        return view("Usuarios/listaborrarusuarios", $data);
    }
    public function borrar($id=null){
        
    $this->usuario = new Usuario();
    $datosImagen = $this->usuario->where('Idusuario', $id)->first();
                if($datosImagen['foto']!=''){
                $ruta = ("../public/uploads/" . $datosImagen['foto']);
                
               if( !is_dir($ruta)){
                if(file_exists($ruta)){
                unlink($ruta);
                }
               }
                }
        $this->usuario->delete($id);
        return redirect()->to(base_url().'listaborrarusuarios');

    }
}