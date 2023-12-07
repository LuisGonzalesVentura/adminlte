<?php

namespace App\Controllers;

use App\Models\Usuario;

class Login extends BaseController
{
    private $usuario;

    public function index()
    {
        return view("Login/index");
    }

    public function validarIngreso()
    {
        $this->usuario = new Usuario();
        $user = $this->usuario->buscarUsuarioActivo($_POST['emailUsuario']);
    
        if ($user) {
            if (password_verify($_POST['clave'], $user->clave)) {
                $data = [
                    "usuarios" => $user->nombre . ' ' . $user->apellido,
                    "foto" => $user->foto,
                    "rol" => $user->rol
                ];
                session()->set($data);
    
                return redirect()->to(base_url('escritorio'));
            } else {
                $mensaje = "Error de inicio de sesión: Contraseña incorrecta";
                $this->mostrarAlerta($mensaje);
            }
        } else {
            $mensaje = "Error de inicio de sesión: Usuario no encontrado o inactivo";
            $this->mostrarAlerta($mensaje);
        }
    }
    
    private function mostrarAlerta($mensaje)
{
    echo "<script>alert('$mensaje'); window.location.href = '" . base_url('Login') . "';</script>";
}

    public function cerrarSesion()
    {
        session()->destroy();
        return redirect()->to(base_url('Login'));
    }
}
