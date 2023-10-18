<?php 

namespace App\Controllers;
use App\Models\Usuario;

class CrearUsuarios extends BaseController
{

    private $usuario;
    public function index()
    {
        $data['titulo']="Crear Usuarios";
        return view("Usuarios/crearusuario", $data);
    }
    public function agregar_usuario()
    {
       $this->usuario=new Usuario();
       $encrypter= \Config\Services::encrypter();
       $clave = bin2hex($encrypter->encrypt(isset($_POST['contrasena']) ? $_POST['contrasena'] : ''));
       
       $nombre="";
       if($imagen=$this->request->getFile('fotoUsuario')){
        
       $nombre=$imagen->getRandomName();
        $imagen->move("../public/uploads/".$nombre);
       }
       $datos=['nombre' => isset($_POST['nombre']) ? $_POST['nombre'] : '',
       'apellido' => isset($_POST['apellido']) ? $_POST['apellido'] : '',
       'email' => isset($_POST['email']) ? $_POST['email'] : '',
       'usuario' => isset($_POST['usuario']) ? $_POST['usuario'] : '',
       'clave' =>$clave ,
       'fecha_nacimiento' => isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : '',
       'foto' =>$nombre,
       'numero' => isset($_POST['numero']) ? $_POST['numero'] : '',
       'fecha_creacion' =>date('Y-m-d')
                    ];

       $this->usuario->protect(false);
       $this->usuario->insert($datos);
       header("Location:".$_SERVER['HTTP_REFERER']);

       exit();

    

  }

}