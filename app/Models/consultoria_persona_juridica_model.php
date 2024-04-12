<?php

namespace App\Models;

use CodeIgniter\Model;

class consultoria_persona_juridica_model extends Model
{
    protected $table = 'consultor_persona_juridica';
    protected $primaryKey = 'id_c_p';
    protected $returnType = 'object'; // Establecer el retorno como objeto

    protected $allowedFields = [
        'NombreEmpresa_c_p',
        'SiglaEmpresa_c_p',
        'NITEmpresa_c_p',
        'RepresentanteLegal_ApellidoPaterno_c_p',
        'RepresentanteLegal_ApellidoMaterno_c_p',
        'RepresentanteLegal_Nombres_c_p',
        'FechaInicioConsultoria_c_p',
        'FechaConclusionConsultoria_c_p',
        'OficinaID_c_p',
        'Proyecto_c_p',
        'TemaConsultoria_c_p',
        'ProductosEntregados_c_p',
        'Archivo_c_p',
        'TerminoReferencia_TDR_c_p',
        'PropuestaEmpresa_c_p',
        'ActaSeleccionEmpresa_c_p',
        'Nitdelaenmpresa_c_p',
        'PoderRepresentanteLegal_c_p',
        'CurriculumEmpresa_c_p',
        'CurriculumProfesionales_c_p',
        'DeclaracionJuradaAntecedentes_c_p',
        'BoletaGarantia_c_p',
        'FormulariosPagoSeguroLargoPlazo_c_p',
        'InformeFinalProductoEntregado_c_p',
        'ActaConformidadServicio_c_p',
    ];

    // Si es necesario, definir relaciones con otras tablas aquí
    
}
