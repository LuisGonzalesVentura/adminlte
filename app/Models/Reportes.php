<?php
namespace App\Models;

use CodeIgniter\Model;

class Reportes extends Model
{
    protected $table = 'reportes';
    protected $primaryKey = 'Idreporte';
    protected $returnType = 'object'; // Establecer el retorno como objeto

    protected $allowedFields = [
        'apellido', 'apellido_materno', 'nombre', 'Ci', 'cargo', 'nua', 'fechaingreso', 'fechafin',
        'genero', 'motivo_conclusion',  'proyecto',
        
        
        'acta_de_seleccion',
        'informe_examen_psicologico', 'certificado_de_antecedentes_penales', 'carnetescaneado',
        'certificado_de_no_violencia', 'curriculum_vitae', 'memorandum_asignacion_del_cargo',
        'ingresocaja', 'carnet_de_asegurado_cps', 'formulario_aporte_seguro_a_largo_plazo',
        'formulario_de_desvinculacion', 'certificado_trabajo',
        
        
        'ubicacion',
        'oficina_id' // Agrega la nueva columna a la lista de allowedFields
    ];



    public function oficina()
    {
        return $this->belongsTo('App\Models\Oficina', 'oficina_id', 'id');
    }





}

