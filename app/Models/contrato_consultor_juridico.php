<?php

namespace App\Models;

use CodeIgniter\Model;

class contrato_consultor_juridico extends Model
{
    protected $table = 'contratos_consultor_juridico';
    protected $primaryKey = 'idcontrato_c_j';
    protected $allowedFields = [
        'empleado_c_j',
        'archivo_c_j',
        'tipo_contrato_c_j',
        'fecha_inicio_contrato_c_j',
        'fecha_finalizacion_contrato_c_j',
        'usuario_creator_c_j',
        'fecha_creacion_c_j', 
        'fecha_modificacion_c_j'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'fecha_creacion_c_j';
    protected $updatedField = 'fecha_modificacion_c_j';

    protected $returnType = 'object'; // Opcional: Puedes cambiar a 'array' si prefieres arrays en lugar de objetos





    
    public function tipoContrato()
{
    return $this->belongsTo('App\Models\TipoContrato', 'tipo_contrato_c_j', 'id_contrato');
}

    
    // Si es necesario, puedes definir relaciones con otras tablas aquí
}
