<?php

namespace App\Models;

use CodeIgniter\Model;

class Oficina extends Model
{
    protected $table = 'dni_filiales';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre_filial', 'id_usuario', 'fecha_creacion', 'fecha_modificacion'
    ];

    // You can define any validation rules or other model-specific logic here.

    // For example:
    protected $validationRules = [
        'nombre_filial' => 'required',
        'id_usuario' => 'required|integer',
        'fecha_creacion' => 'required|valid_date',
        'fecha_modificacion' => 'valid_date'
    ];

    // If you have a Users model, you can define a relationship with it:
    protected $returnType = 'object';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario', 'Idusuario');
    }
    
    


    // En tu modelo DniFiliales (app/Models/DniFiliales.php)
// En tu modelo DniFiliales (app/Models/DniFiliales.php)
public function crearFilial($nombreFilial, $idUsuario)
{
    $data = [
        'nombre_filial' => $nombreFilial,
        'id_usuario' => $idUsuario,
        'fecha_creacion' => date('Y-m-d'), // Fecha actual
        'fecha_modificacion' => '0000-00-00', // Fecha de modificación inicial
    ];

    return $this->insert($data);
}


}
