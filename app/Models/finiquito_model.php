<?php

namespace App\Models;

use CodeIgniter\Model;

class finiquito_model extends Model
{
    protected $table = 'finiquitos';
    protected $primaryKey = 'id_finiquito_f';
    protected $allowedFields = [
        'id_empleado_f', 
        'archivo_f', 
        'usuario_creador_f', 
        'fecha_de_finiquito_f', 
        'fecha_modificacion_finiquito_f'
    ];
    
    // Establecer useTimestamps a false para que no se utilicen las marcas de tiempo
    protected $useTimestamps = false;

    protected $validationRules = [
        // Puedes agregar reglas de validación si es necesario
    ];

    public function usuarioCreador()
    {
        return $this->belongsTo('App\Models\Usuario_model', 'usuario_creador_f', 'Idusuario', 'nombre');
    }
    
    public function empleado()
    {
        // Asegurarse de cargar la relación correctamente
        return $this->belongsTo('App\Models\Reporte_model', 'id_empleado_f', 'Idreporte');
    }

    public function getFiniquitosByReportId($reportId)
    {
        // Assuming the foreign key linking reportes and finiquitos is 'id_empleado_f'
        return $this->where('id_empleado_f', $reportId)->findAll();
    }
}
