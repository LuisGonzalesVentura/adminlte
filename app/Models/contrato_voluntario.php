<?php

namespace App\Models;

use CodeIgniter\Model;

class contrato_voluntario extends Model
{
    protected $table = 'contratos_voluntarios';
    protected $primaryKey = 'id_c_v';
    protected $allowedFields = [
        'Voluntario_id',
        'archivo_v',
        'tipo_contrato_voluntario',
        'fecha_inicio_contrato_voluntario',
        'fecha_finalizacion_contrato_voluntario',
        'usuario_creator_voluntario',
        'fecha_creacion_voluntario',
        'fecha_modificacion_voluntario'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'fecha_creacion_voluntario';
    protected $updatedField = 'fecha_modificacion_voluntario';

    protected $returnType = 'object'; // Opcional: Puedes cambiar a 'array' si prefieres arrays en lugar de objetos

    public function tipoContrato()
    {
        return $this->belongsTo('App\Models\TipoContrato', 'tipo_contrato_voluntario', 'id_contrato');
    }

    // Si es necesario, puedes definir relaciones con otras tablas aquí
}
