<?php

namespace App\Models;

use CodeIgniter\Model;

class contrato_consultor_n extends Model
{
    protected $table = 'contratos_consultor_n';
    protected $primaryKey = 'idcontrato_c_n';

    protected $allowedFields = [
        'id_empleado_c_n', 
        'archivo_c_n', 
        'tipo_contrato_c_n', 
        'fecha_inicio_contrato_c_n', 
        'fecha_finalizacion_contrato_c_n', 
        'usuario_creator_c_n', 
        'fecha_creacion_c_n', 
        'fecha_modificacion_c_n'
    ];
    protected $useTimestamps = false;
    
    protected $validationRules = [
        // Agrega las reglas de validación si es necesario
    ];

    // Relación con el modelo Usuario
    // Relación con el modelo Usuario
public function usuarioCreator()
{
    return $this->belongsTo('App\Models\Usuario', 'usuario_creator_c_n', 'Idusuario');
}


    // Relación con el modelo TipoContrato
    public function tipoContrato()
    {
        return $this->belongsTo('App\Models\TipoContrato', 'tipo_contrato_c_n', 'id_contrato');
    }

    // Función para obtener los contratos por ID de consultor
    public function getContratosByConsultorId($consultorId)
    {
        $contratos = $this->select('contratos_consultor_n.*, tipo_contrato.tipo_contrato as tipo_contrato')
                    ->join('tipo_contrato', 'tipo_contrato.id_contrato = contratos_consultor_n.tipo_contrato_c_n', 'left')
                    ->where('id_empleado_c_n', $consultorId)
                    ->findAll();

        return $contratos;
    }
}
