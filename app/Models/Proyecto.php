<?php

namespace App\Models;

use CodeIgniter\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $primaryKey = 'ID_proyecto';
    protected $allowedFields = ['oficinaproyecto','financiador','codigo_del_proyecto','nombre_proyecto', 'descripcion_proyecto', 'fecha_inicio', 'fecha_fin', 'ruta_documentacion_pdf'];
}
    