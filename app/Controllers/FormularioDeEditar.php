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
    // prueba
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

    $datos = [
        'nombre' => $this->request->getPost('nombre'),
        'apellido' => $this->request->getPost('apellido'),
        'email' => $this->request->getPost('email'),
        'usuario' => $this->request->getPost('usuario'),
        'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
        'numero' => $this->request->getPost('numero'),
        'fecha_modificacion' => date('Y-m-d'),
    ];

    $nuevaContrasena = $this->request->getPost('contrasena');
    if (!empty($nuevaContrasena)) {
        $hashedPassword = password_hash($nuevaContrasena, PASSWORD_BCRYPT);
        $datos['clave'] = $hashedPassword;
    }

    $this->usuario->protect(false);

    $this->usuario->update($Idusuario, $datos);

    $validar = $this->validate([
        'fotoUsuario' => [
            'uploaded[fotoUsuario]',
            'mime_in[fotoUsuario,image/jpg,image/png,image/jpeg]',
            'max_size[fotoUsuario,1024]'
        ]
    ]);

    if ($validar) {
        $imagen = $this->request->getFile('fotoUsuario');
        $datosImagen = $this->usuario->where('Idusuario', $Idusuario)->first();

        if ($datosImagen['foto'] != '') {
            $ruta = "../public/uploads/" . $datosImagen['foto'];
            // Verificamos que sea un archivo antes de intentar eliminarlo
            if (is_file($ruta)) {
                unlink($ruta);
            }
        }

        $nombre = $imagen->getName();
        $imagen->move("../public/uploads/", $nombre);

        $datos = ['foto' => $nombre];
        $this->usuario->update($Idusuario, $datos);
    }

    return redirect()->to(base_url().'listaeditarusuarios');
}


}
