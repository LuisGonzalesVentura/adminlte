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

        $user=null;

        foreach($datos['usuarios'] as $usuario){
          if($usuario['usuario']==$_POST['emailUsuario']){
            
              if(password_verify($_POST['clave'], $usuario['clave'])){
/* usar para el guardado en la base de datos de la contraseÃ±a
            * $contrasena = "mi_contrasena";*/
                 
               $user=$usuario;
               break;
              }else
              {
                
              }

          }

        }
        if(is_null($user)){
          header("Location:".$_SERVER['HTTP_REFERER']);

               exit();
        }
        else{
          
          
          return redirect()->to(base_url().'escritorio');
          }

    

  }

    
    
    


}
