<?php

namespace App\Models;

use CodeIgniter\Model;

class registroconsultoria_n extends Model
{
    protected $table = 'registroconsultoria';
    protected $primaryKey = 'consultoria_id_n';
    protected $returnType = 'object'; // Establecer el retorno como objeto

    protected $allowedFields = [
        'carnet_identidad_n', 'nua_n', 'nit_n', 'apellido_paterno_n', 'apellido_materno_n',
        'nombres_n', 'genero_n', 'inicio_servicio_n', 'conclusion_servicio_n', 'oficina_id',
        'proyecto_n', 'tema_consultoria_n', 'productos_entregados_n',
        
        
        
        'terminos_referencia_n',
        'propuesta_profesional_n', 'acta_seleccion_proveedor_n', 'certificado_antecedentes_penales_n',
        'certificado_no_violencia_n', 'carnet_asegurado_n', 'curriculum_vitae_profesional_n',
        'carnet_identidad_profesional_n', 'nit_profesional_n', 'boleta_garantia_n',
         'formularios_pago_seguro_largo_plazo_n',
        'informe_final_producto_entregado_n', 'acta_conformidad_servicio_n'

        ,'ubicacion_n'
    ];
    public function oficina()
    {
        return $this->belongsTo('App\Models\Oficina', 'oficina_id', 'id');
    }
    
    
}
