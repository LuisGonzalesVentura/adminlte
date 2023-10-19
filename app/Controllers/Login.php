<?php

namespace App\Controllers;
use App\Models\Usuario;

class Login extends BaseController
{

    private $usuario;

    public function index()
    {


      /*$encrypter= \Config\Services::encrypter();
       $clave = bin2hex($encrypter->encrypt(123));
       echo $clave;*/
      
       return view("Login/index");



    }

    public function validarIngreso()
    {
       $this->usuario=new Usuario();
        $datos['usuarios']=$this->usuario->orderBy('Idusuario','ASC')->findAll();
        session()->set($datos); 

        $user=null;

        foreach($datos['usuarios'] as $usuario){
          if($usuario['usuario']==$_POST['emailUsuario']){
            
              if(password_verify($_POST['clave'], $usuario['clave'])){

                 
               $user=$usuario;
               
              }else
              {
                echo "error usuario";
                
              }

          }

        }
        if(is_null($user)){
          header("Location:".$_SERVER['HTTP_REFERER']);

               exit();
        }
        else{
          $data=[
            "usuarios" => $user['nombre'] . ' ' . $user['apellido'],
            "foto" => $user['foto']
  
          ];
            session()->set($data);
            
            return redirect()->to(base_url().'escritorio');
          }

    

  }

  public function cerrarSesion()
    {
      session()->destroy();
      return redirect()->to(base_url().'Login');
    }
    

    
    
    


}
