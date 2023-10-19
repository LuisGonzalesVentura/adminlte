<?php

namespace App\Controllers;

use App\Models\Usuario;

class formularioDeEditar extends BaseController
{

    private $usuarios;
    private $usuario;

    /*public function index()
    {
        $data['titulo']="Formulario Editar";
        return view("Usuarios/formulariodeeditar", $data);
    }*/
    public function editar($id = null)
    {

        $this->usuarios = new Usuario();
        $datos['user'] = null;
        $datos['usuarios'] = $this->usuarios->orderBy('Idusuario', 'ASC')->findAll();
        foreach ($datos['usuarios'] as $usuario) {
            if ($usuario['Idusuario'] == $id) {
                $datos['user'] = $usuario;
            }
        }
        //session()->set($data); 
        $data['user'] = $datos['user'];
        $data['titulo'] = "Formulario Editar";
        $data['id'] = "";
        $data['id'] = $id;

        return view("Usuarios/formulariodeeditar", $data);
    }
    public function editarUsuario($Idusuario = null)
    {

        $this->usuario = new Usuario();


        $encrypter = \Config\Services::encrypter();
        $clave = bin2hex($encrypter->encrypt(isset($_POST['contrasena']) ? $_POST['contrasena'] : ''));
        //$imagen = $this->request->getFile('fotoUsuario');
        // $nombre = $imagen->getRandomName();
        //$imagen->move("../public/uploads/" . $nombre);
        $datos = [
            'nombre' => isset($_POST['nombre']) ? $_POST['nombre'] : '',
            'apellido' => isset($_POST['apellido']) ? $_POST['apellido'] : '',
            'email' => isset($_POST['email']) ? $_POST['email'] : '',
            'usuario' => isset($_POST['usuario']) ? $_POST['usuario'] : '',
            'clave' => $clave,
            'fecha_nacimiento' => isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : '',
            // 'foto' => $nombre,
            'numero' => isset($_POST['numero']) ? $_POST['numero'] : '',
            'fecha_modificacion' => date('Y-m-d')
        ];
        $this->usuario->protect(false);

        $this->usuario->update($Idusuario, $datos);
        $validar = $this->validate(['fotoUsuario' => [
            'uploaded[fotoUsuario]',
            'mime_in[fotoUsuario,image/jpg,image/png,image/jpeg]',
            'max_size[fotoUsuario,1024]'
        ]]);
        if ($validar) {
            if ($imagen = $this->request->getFile('fotoUsuario')) {
                echo "cargando imagen";
                $datosImagen = $this->usuario->where('Idusuario', $Idusuario)->first();
                if($datosImagen['foto']!=''){
                $ruta = ("../public/uploads/" . $datosImagen['foto']);
                
                unlink($ruta);
                }
                $nombre = $imagen->getRandomName();
                $imagen->move("../public/uploads/" . $nombre);
                $datos = ['foto' => $nombre];
                $this->usuario->update($Idusuario, $datos);
            }
        }
        return redirect()->to(base_url().'listaeditarusuarios');
    }
}
