<?php

namespace App\Models;

use CodeIgniter\Model;

class VoluntarioModel extends Model
{
    protected $table = 'voluntarios'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_voluntario'; // Nombre de la clave primaria
    protected $returnType = 'object'; // Tipo de datos que se devolverán

    protected $allowedFields = [
        'carnet_identidad_v',
        'apellido_paterno_v',
        'apellido_materno_v',
        'nombres_v',
        'genero_v',
        'fecha_inicio_servicio_v',
        'fecha_conclusion_servicio_v',
        'tipo_voluntariado_v',
        'universidad_instituto_v',
        'carrera_especialidad_v',
        'id_oficina_v',
        'proyecto_v',
        'area_voluntariado_v',
        'productos_entregados_v',
        'archivo_v',


        'convenio_interinstitucional_v',
        'carta_solicitud_voluntariado_v',
        'carnet_identidad_voluntariado_v',
        'curriculum_vitae_v',
        'declaracion_antecedentes_penales_v',
        'certificado_antecedentes_penales_v',
        'certificado_no_violencia_v',
        'informe_examen_psicologico_v',
        'carnet_asegurado_seguro_corto_plazo_v',
        'informe_final_producto_entregado_v',
        'certificado_voluntariado_v'
    ];

    // Si es necesario, puedes definir relaciones con otras tablas aquí
}
