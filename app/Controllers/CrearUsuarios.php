<?php 

namespace App\Controllers;
use App\Models\Usuario;

class CrearUsuarios extends BaseController
{

    private $usuario;
    public function index()
    {
        $data['titulo']="Crear Usuarios";
        return view("Usuarios/crearusuario",$data);
    }
    public function agregar_usuario()
{
    $this->usuario = new Usuario();

    // Obtén la contraseña proporcionada por el usuario
    $plainPassword = $this->request->getPost('contrasena');

    // Genera un hash de la contraseña usando password_hash
    $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

    // Verifica si se ha subido una imagen
    $imagen = $this->request->getFile('fotoUsuario');
    $nombre = "";
    if ($imagen->isValid() && !$imagen->hasMoved()) {
        // Genera un nombre de archivo único basado en la marca de tiempo y la extensión original
        $nombre = md5(uniqid(rand(), true)) . '.' . $imagen->getClientExtension();

        // Mueve la imagen al directorio de uploads
        $imagen->move("../public/uploads/", $nombre);}
    // Construye el array de datos para insertar en la base de datos
    $datos = [
        'nombre' => $this->request->getPost('nombre'),
        'apellido' => $this->request->getPost('apellido'),
        'email' => $this->request->getPost('email'),
        'usuario' => $this->request->getPost('usuario'),
        'clave' => $hashedPassword, // Almacena el hash de la contraseña
        'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
        'foto' => $nombre,
        'numero' => $this->request->getPost('numero'),
        'fecha_creacion' => date('Y-m-d')
    ];

    // Desactiva la protección de campos, si es necesario
    $this->usuario->protect(false);

    // Inserta los datos en la base de datos
    $this->usuario->insert($datos);

    // Redirige de vuelta a la página anterior
    header("Location:" . $_SERVER['HTTP_REFERER']);
    exit();
}


}