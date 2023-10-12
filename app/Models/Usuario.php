<?php 

namespace App\Models;
use CodeIgniter\Model;

class Usuario extends Model{
protected $table='usuario';
protected $primarKey = 'Idusuario';
protected $allowedField=['nombre','apellido','email','usuario','clave','fecha_nacimiento','estado','fecha_creacion','fecha_modificacion','foto','numero'];
}
