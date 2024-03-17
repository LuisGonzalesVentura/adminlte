<?php

namespace App\Models;

use CodeIgniter\Model;

class ContratoModel extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'idcontrato_c';

    protected $allowedFields = [
        'id_empleado_c', 
        'archivo_c', 
        'tipo_contrato_c', 
        'fecha_inicio_contrato_c', 
        'fecha_finalizacion_contrato_c', 
        'usuario_creator_c', 
        'fecha_creacion_c', 
        'fecha_modificacion_c'
    ];
    protected $useTimestamps = false;
    
    public function usuarioCreator()
{
    return $this->belongsTo('App\Models\Usuario', 'usuario_creator_c', 'Idusuario','nombre');
}

    protected $validationRules = [
        // Agrega las reglas de validación si es necesario
 
    ];


        // En el modelo Empleado
        public function empleado()
        {
            return $this->belongsTo('App\Models\Empleado', 'id_empleado');
        }
// Function to get contracts by report ID
// ContratoModel.php

public function getContratosByReportId($reportId)
{
    $contratos = $this->select('contratos.*, tipo_contrato.tipo_contrato as tipo_contrato')
                    ->join('tipo_contrato', 'tipo_contrato.id_contrato = contratos.tipo_contrato_c', 'left')
                    ->where('id_empleado_c', $reportId)
                    ->findAll();

    // Debugging: Print the retrieved contracts
    

    return $contratos;
}




}
