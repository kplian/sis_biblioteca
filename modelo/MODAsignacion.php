<?php
/**
*@package pXP
*@file gen-MODAsignacion.php
*@author  (admin)
*@date 11-02-2015 19:57:00
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODAsignacion extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarAsignacion(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='bibl.ft_asignacion_sel';
		$this->transaccion='BIBLIO_ASIG_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_asignacion','int4');
		$this->captura('id_herramienta','int4');
		$this->captura('fecha_prestamo','date');
		//$this->captura('cantidad','int4');
		$this->captura('id_funcionario','int4');
		$this->captura('fecha_devolucion','date');
		$this->captura('estado_reg','varchar');
		$this->captura('observaciones','text');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('desc_herramienta','varchar');
		$this->captura('desc_funcionario2','text');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarAsignacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='bibl.ft_asignacion_ime';
		$this->transaccion='BIBLIO_ASIG_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_herramienta','id_herramienta','int4');
		$this->setParametro('fecha_prestamo','fecha_prestamo','date');
		//$this->setParametro('cantidad','cantidad','int4');
		$this->setParametro('id_funcionario','id_funcionario','int4');
		$this->setParametro('fecha_devolucion','fecha_devolucion','date');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('observaciones','observaciones','text');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarAsignacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='bibl.ft_asignacion_ime';
		$this->transaccion='BIBLIO_ASIG_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_asignacion','id_asignacion','int4');
		$this->setParametro('id_herramienta','id_herramienta','int4');
		$this->setParametro('fecha_prestamo','fecha_prestamo','date');
		//$this->setParametro('cantidad','cantidad','int4');
		$this->setParametro('id_funcionario','id_funcionario','int4');
		$this->setParametro('fecha_devolucion','fecha_devolucion','date');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('observaciones','observaciones','text');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarAsignacion(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='bibl.ft_asignacion_ime';
		$this->transaccion='BIBLIO_ASIG_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_asignacion','id_asignacion','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>