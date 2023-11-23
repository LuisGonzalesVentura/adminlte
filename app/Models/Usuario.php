<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'Idusuario';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'usuario', 'clave', 'fecha_nacimiento', 'estado', 'fecha_creacion', 'fecha_modificacion', 'foto', 'numero'];

    public function buscarUsuarioPorUsuario($usuario)
    {
        $db = db_connect();
        $builder = $db->table($this->table)->where('usuario', $usuario)->where('estado', 'Activo');
        $resultado = $builder->get();
        return $resultado->getResult() ? $resultado->getResult()[0] : false;
    }
}
