<?php

namespace App\Models;

use CodeIgniter\Model;

class Reportes extends Model
{
    protected $table = 'reportes';
    protected $primaryKey = 'Idreporte';
    protected $allowedFields = ['apellido', 'nombre', 'Ci', 'fechanacimiento', 'nua', 'fechaingreso', 'fechafin', 'carnetescaneado', 'ingresocaja', 'contrato1', 'finiquito1', 'retirocaja','ubicacion'];
}
