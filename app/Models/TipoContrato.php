<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoContrato extends Model
{
    protected $table = 'tipo_contrato';
    protected $primaryKey = 'id_contrato';
    protected $allowedFields = [
        'tipo_contrato', 'usuario_id', 'fecha_creacion', 'fecha_modificacion'
    ];

    // You can define any validation rules or other model-specific logic here.

    // For example:
    protected $validationRules = [
        'tipo_contrato' => 'required',
        'usuario_id' => 'required|integer',
        'fecha_creacion' => 'required|valid_date',
        'fecha_modificacion' => 'valid_date'
    ];

    // If you have a Users model, you can define a relationship with it:
    protected $returnType = 'object';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id', 'Idusuario');
    }
    
    


    // En tu modelo DniFiliales (app/Models/DniFiliales.php)
// En tu modelo DniFiliales (app/Models/DniFiliales.php)
public function crearContrato($nombreContrato, $idUsuario)
{
    $data = [
        'tipo_contrato' => $nombreContrato,
        'usuario_id' => $idUsuario,
        'fecha_creacion' => date('Y-m-d'), // Fecha actual
        'fecha_modificacion' => '0000-00-00', // Fecha de modificación inicial
    ];

    return $this->insert($data);
}


}
