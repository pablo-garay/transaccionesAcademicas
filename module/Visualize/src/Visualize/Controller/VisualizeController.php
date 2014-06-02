<?php
namespace Visualize\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DOMPDFModule\View\Model\PdfModel;

class VisualizeController extends AbstractActionController
{

    public function indexAction()
    {        
    	return array();
    }

    public function seccionAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'seccionActual' => '---',
            'seccionObj' => '---',
            'motivo' => $solicitudData['motivo'],
            'especificacion_motivo' => $solicitudData['especificacion_motivo'],
        ));
        return $pdf;
    }

    public function certificadoAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'documento' => '---',
            'telefono' => $solicitudData['telefono'],
        	// CAMPOS DE SOLICITUD
            'email' => '---',
            'materiasDiurnas' => '---',
            'materiasNocturnas' => '---',
            'tipo' => $solicitudData['tipo_de_titulo'],
            'titulo' => '---',
            'respuesta' => '---',
            'observaciones' => $solicitudData['aclaraciones'],
        ));
        return $pdf;
    }

    public function colaboradorAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
        	'profesor' => $solicitudData['profesor'],
            'asignatura' => $solicitudData['asignatura'],
            'adjunto' => '---'
        ));
        return $pdf;
    }

    public function creditosAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'actividad' => '---',
            'fechaIni' => $solicitudData['fecha_inicio'],
            'fechaFin' => $solicitudData['fecha_fin'],
            'descripcion' => $solicitudData['descripcion_actividades'],
        ));
        return $pdf;
    }

    public function desinscripcionAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'codigo' => '---'
        ));
        return $pdf;
    }

    public function exoneracionAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'motivo' => $solicitudData['motivo'],
            'esp_motivo' => $solicitudData['especificacion_motivo'],
            'adjunto' => '---',
            'esp_adjunto' => '---'
        ));
        return $pdf;
    }

    public function extraordinarioAction()
    {
        $solicitudData = $this->params('solicitudData');
        
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // Informacion para la solicitud
            'asignatura' => $solicitudData['asignatura'],
            'fechaEXA' => $solicitudData['fecha_extraordinario'],
            'profesor' => $solicitudData['profesor'],
        	'motivo' => $solicitudData['motivo'],        		
            'adjunto' => '---'
        ));
        return $pdf;
    }

    public function inclusionAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'motivo' => $solicitudData['motivo'],
            'descripcion' => $solicitudData['especificacion_motivo'],
        ));
        return $pdf;
    }

    public function tardiaAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'oportunidad' => $solicitudData['oportunidad'],
            'fechaEXA' => $solicitudData['fecha_de_examen'],
            'motivo' => $solicitudData['motivo'],
        	'especificacion' => $solicitudData['especificacion_motivo'],
            'adjunto' => '---',
        ));
        return $pdf;
    }

    public function pasantiaAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'lugar' => $solicitudData['lugar'],
            'direccion' => $solicitudData['direccion'],
        	'lugar_telefono' => $solicitudData['telefono'],
            'email' => $solicitudData['correo_electronico'],
            'motivo' => $solicitudData['motivo'],
            'esp_motivo' => $solicitudData['especificacion_motivo'],
            'adjunto' => '---',
            'esp_adjunto' => '---'
        ));
        return $pdf;
    }

    public function reduccionAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'motivo' => $solicitudData['motivo'],
            'adjunto' => '---'
        ));
        return $pdf;
    }

    public function revisionescolaridadAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
        ));
        return $pdf;
    }

    public function revisionexamenAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'profesor' => $solicitudData['profesor'],
            'fechaEXA' => $solicitudData['fecha_examen'],
            'oportunidad' => $solicitudData['oportunidad'],
            'calificacion_obtenida' => $solicitudData['calificacion_previa'],
            'motivo' => $solicitudData['motivo'],
            'fechaREVI' => $solicitudData['fecha_revision'],
            'horaREVI' => $solicitudData['hora_revision'],
            'lugarREVI' => $solicitudData['lugar_revision'],
        ));
        return $pdf;
    }

    public function rupturaAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'materiaCo' => '---',
            'motivo' => $solicitudData['motivo'],
            'descripcion' => '---'
        ));
        return $pdf;
    }

    public function tituloAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'titulo' => $solicitudData['nombre_titulo'],
        	'fotocopia_cedula' => $solicitudData['fotocopia_cedula'],
        	'fotocopia_certificado_nacimiento' => $solicitudData['fotocopia_certificado_nacimiento'],
        	'fotocopia_certificado_matrimonio' => $solicitudData['fotocopia_certificado_matrimonio'],
        	'fotocopia_de_titulo_de_grado' => $solicitudData['fotocopia_de_titulo_de_grado'],
        	'fotocopia_simple_de_titulo' => $solicitudData['fotocopia_simple_de_titulo'],
        	'otros' => $solicitudData['otros'],
        	'descripcion_otros' => $solicitudData['especificacion_otros'],
        ));
        return $pdf;
    }

    public function traspasoAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
//             'seccion' => '---',
            'op_pagada' => $solicitudData['oportunidad_pagada'],
            'fecha_pagada' => $solicitudData['fecha_oportunidad_pagada'],
            'op_apagar' => $solicitudData['oportunidad_a_pagar'],
            'fecha_apagar' => $solicitudData['fecha_oportunidad_a_pagar'],
        ));
        return $pdf;
    }

    public function tutoriaAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'profesor' => $solicitudData['profesor'],
            'motivo' => $solicitudData['motivo'],
            'esp_motivo' => $solicitudData['especificacion_motivo'],
            'adjunto' => '---',
            'esp_adjunto' => '---'
        ));
        return $pdf;
    }

    public function fueraAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asignatura' => $solicitudData['asignatura'],
            'motivo' => $solicitudData['motivo'],
            'esp_motivo' => $solicitudData['especificacion_motivo'],
        ));
        return $pdf;
    }

    public function variasAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'asunto' => $solicitudData['asunto'],
            'motivo' => $solicitudData['especificacion_motivo'],
        ));
        return $pdf;
    }

    public function tesisAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'tema' => $solicitudData['tema_tesis'],
            'integrante' => '---',
            'profesor' => $solicitudData['profesor'],
            'adjunto' => '---',
            'esp_adjunto' => '---'
        ));
        return $pdf;
    }

    public function convalidacionAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
            'universidad' => $solicitudData['universidad_origen'],
            'direUniversidad' => $solicitudData['direccion_universidad_origen'],
            'telUniversidad' => $solicitudData['telefono_universidad_origen'],
            'emailUniversidad' => $solicitudData['email_universidad_origen'],
            'carrera' => $solicitudData['carrera_cursada_universidad_origen'],
        ));
        return $pdf;
    }

    public function homologacionAction($solicitudData)
    {
    	$solicitudData = $this->params('solicitudData');
    	
    	$pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => $solicitudData['mesa_entrada'],
            'fecha' => $solicitudData['fecha_solicitada'],
            'nombre' => $solicitudData['nombres'],
            'apellido' => $solicitudData['apellidos'],
            'matricula' => $solicitudData['matricula'],
            'carrera' => $solicitudData['carrera'],
            'telefono' => $solicitudData['telefono'],
            // CAMPOS DE SOLICITUD
        	'plan_de_estudio_previo' => $solicitudData['plan_de_estudio_previo'],
        	'plan_de_estudio_nuevo' => $solicitudData['plan_de_estudio_nuevo'],
        	'carrera_anterior' => $solicitudData['carrera_anterior'],
        ));
        return $pdf;
    }
}
