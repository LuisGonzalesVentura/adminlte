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
        $usuarios = $this->usuario->where('usuario', $_POST['emailUsuario'])->findAll();

        if (!empty($usuarios)) {
            $user = $usuarios[0];

            if (password_verify($_POST['clave'], $user['clave'])) {
                // Contraseña válida
                $data = [
                    "usuarios" => $user['nombre'] . ' ' . $user['apellido'],
                    "foto" => $user['foto']
                ];
                session()->set($data);

                return redirect()->to(base_url('escritorio'));
            } else {
                // Contraseña incorrecta
                echo "Error de inicio de sesión: Contraseña incorrecta";
            }
        } else {
            // Usuario no encontrado
            echo "Error de inicio de sesión: Usuario no encontrado";
        }
    }

    public function cerrarSesion()
    {
        session()->destroy();
        return redirect()->to(base_url('Login'));
    }
}
