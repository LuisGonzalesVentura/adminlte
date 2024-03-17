<?php 

namespace App\Models;
use codeIgniter\Model;

class Usuario extends Model{
    protected $table='usuario';
    protected $primarKey = 'id';
    

    public function buscarUsuarioPorEmail($email)
    {
       $db=db_connect();
       $builder=$db->table($this->table)->where('email',$email)->where('
       estado','Activo');
       $resultado=$builder->get();
       return $resultado->getResult()?$resultado->getResult()[0]:false;
    }
    public function buscarUsuarioPorUsuario($usuario)
    {
       $db=db_connect();
       $builder=$db->table($this->table)->where('usuario',$usuario)->where('
       estado','Activo');
       $resultado=$builder->get();
       return $resultado->getResult() ? $resultado->getResult()[0]:false;
    }

    // En el modelo Usuario, ajusta el método find() para que devuelva un objeto en lugar de un array

}