<?php
/**
*@package pXP
*@file gen-ACTAsignacion.php
*@author  (admin)
*@date 11-02-2015 19:57:00
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTAsignacion extends ACTbase{    
			
	function listarAsignacion(){
		$this->objParam->defecto('ordenacion','id_asignacion');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODAsignacion','listarAsignacion');
		} else{
			$this->objFunc=$this->create('MODAsignacion');
			
			$this->res=$this->objFunc->listarAsignacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarAsignacion(){
		$this->objFunc=$this->create('MODAsignacion');	
		if($this->objParam->insertar('id_asignacion')){
			$this->res=$this->objFunc->insertarAsignacion($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarAsignacion($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarAsignacion(){
			$this->objFunc=$this->create('MODAsignacion');	
		$this->res=$this->objFunc->eliminarAsignacion($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>