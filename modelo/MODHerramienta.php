<?php
/**
*@package pXP
*@file gen-MODHerramienta.php
*@author  (admin)
*@date 05-02-2015 21:24:44
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODHerramienta extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarHerramienta(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='bibl.ft_herramienta_sel';
		$this->transaccion='BIBLIO_HERR_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_herramienta','int4');
		$this->captura('id_categoria','int4');
		$this->captura('estado_reg','varchar');
		//$this->captura('enlace','varchar');
		$this->captura('vigencia_licencia','date');
		$this->captura('tipo','varchar');
		$this->captura('autor','varchar');
		$this->captura('contenido','text');
		$this->captura('titulo','varchar');
		$this->captura('licencia','varchar');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_reg','int4');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('desc_categoria','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarHerramienta(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='bibl.ft_herramienta_ime';
		$this->transaccion='BIBLIO_HERR_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_categoria','id_categoria','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		//$this->setParametro('enlace','enlace','varchar');
		$this->setParametro('vigencia_licencia','vigencia_licencia','date');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('autor','autor','varchar');
		$this->setParametro('contenido','contenido','text');
		$this->setParametro('titulo','titulo','varchar');
		$this->setParametro('licencia','licencia','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarHerramienta(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='bibl.ft_herramienta_ime';
		$this->transaccion='BIBLIO_HERR_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_herramienta','id_herramienta','int4');
		$this->setParametro('id_categoria','id_categoria','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		//$this->setParametro('enlace','enlace','varchar');
		$this->setParametro('vigencia_licencia','vigencia_licencia','date');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('autor','autor','varchar');
		$this->setParametro('contenido','contenido','text');
		$this->setParametro('titulo','titulo','varchar');
		$this->setParametro('licencia','licencia','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarHerramienta(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='bibl.ft_herramienta_ime';
		$this->transaccion='BIBLIO_HERR_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_herramienta','id_herramienta','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>