<?php
/**
*@package pXP
*@file gen-Herramienta.php
*@author  (admin)
*@date 05-02-2015 21:24:44
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.Herramienta=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.Herramienta.superclass.constructor.call(this,config);
		this.init();
		this.iniciarEventos();
		this.load({params:{start:0, limit:this.tam_pag}});
		
		//this.addButton('btnSubirArchivos',
		this.addButton('btnSubirArchivos',
            {
                iconCls: 'badelante',
                disabled: false,
                tooltip: '<b>Documentos y Archivos de la Biblioteca Virtual</b><br/>Subir los documetos requeridos para cada herramienta respectiva.',
                xtype: 'button',
                text: 'Archivos',
                handler:this.onButtonSubirArchivo,
                scope:this
            }
        );

	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_herramienta'
			},
			type:'Field',
			form:true 
		},
		{
			config: {
				name: 'id_categoria',
				fieldLabel: 'Categoria',
				qtip:'Seleccione la respectiva categoria a la que corresponde su herramienta.',
				typeAhead: false,
				forceSelection: false,
				hiddenName: 'id_categoria',
				allowBlank: false,
				emptyText: 'Seleccione una categoria...',
				store: new Ext.data.JsonStore({
					url: '../../sis_biblioteca/control/Categoria/listarCategoria',
					id: 'id_categoria',
					root: 'datos',
					sortInfo: {
						field: 'nombre_categoria',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_categoria', 'nombre_categoria', 'codigo'],
					remoteSort: true,
					baseParams: {par_filtro: 'movtip.nombre#movtip.codigo'}
				}),
				valueField: 'id_categoria',
				displayField: 'nombre_categoria',
				gdisplayField: 'desc_categoria',
				hiddenName: 'id_categoria',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '85%',
				gwidth: 100,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['desc_categoria']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'movtip.nombre',type: 'string'},
			grid: true,
			egrid: true,
			form: true
		},
		{
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'herr.estado_reg',type:'string'},
				id_grupo:1,
				egrid:true,
				form:false
		},
		{ //Modify combo tipo
			config:{
				name: 'tipo',
				fieldLabel: 'Tipo',
				qtip:'Despliegue el selector y seleccione un respectivo tipo.',
				emptyText:'Seleccione un tipo...',
				allowBlank: false,
				anchor: '85%',
				gwidth: 80,
				maxLength:50,
				store:['libro','software'],
				typeAhead: true
				//fields: ['tipo', 'nombre', 'codigo','tipo_objeto'],			
			},
				type:'ComboBox',
				fields: ['tipo', 'nombre', 'codigo','tipo_de_objeto'],
				filters:{	
	       		         type: 'list',
	       				 options: ['libro','software']
	       		 	},
				id_grupo:0,
				grid:true,
				egrid:true,
				form:true
		},	
		{
			config:{
				name: 'titulo',
				fieldLabel: 'Título',
				qtip:'Introduzca el respectivo nombre o título de la herramienta.',
				//regex : /^[a-zA-Z\s]+$/,
				//regexText : 'Este campo solo permite el ingreso de letras A-Z',
				allowBlank: false,
				anchor: '85%',
				gwidth: 80,
				emptyText: 'Introduzca el título...',
				maxLength:100
			},
				type:'TextField',
				filters:{pfiltro:'herr.titulo',type:'string'},
				id_grupo:1,
				grid:true,
				egrid:true,
				form:true
		},
		/*{
			//configuracion del componente
			config:{
					fieldLabel: "Archivo",
					gwidth: 130,
					//labelSeparator:'',
					inputType:'file',
					name: 'foto',
					buttonText: '',	
					maxLength:150,
					anchor:'80%'					
			},
			type:'Field',
		  form:true 
		},
		{
			config:{
				name: 'enlace',
				fieldLabel: 'Enlace',
				qtip:'Introduzca la direccion de descarga del archivo correspondiente.',
				inputType:'file',
				allowBlank: false,
				anchor: '85%',
				gwidth: 100,
				emptyText:'Introduzca un enlace:https://www.google.com',
				maxLength:512
			},
				type:'Field',
				filters:{pfiltro:'herr.enlace',type:'string'},
				id_grupo:1,
				grid:true,
				egrid:true,
				form:true
		},*/
		{
			config:{
				name: 'licencia',
				fieldLabel: 'Licencia',
				qtip:'Introduzca la respectiva licencia o serial del software.',
				allowBlank: false,
				anchor: '85%',
				gwidth: 80,
				maxLength:512
			},
				type:'TextArea',
				filters:{pfiltro:'herr.licencia',type:'string'},
				id_grupo:1,
				grid:true,
				egrid:true,
				form:true
		},
		{
			config:{
				name: 'vigencia_licencia',
				fieldLabel: 'Validez de licencia',
				qtip:'Seleccione la fecha limite de vigencia del software.',
				allowBlank: false,
				emptyText: 'Seleccione una fecha...',
				anchor: '85%',
				gwidth: 140,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
				type:'DateField',
				filters:{pfiltro:'herr.vigencia_licencia',type:'date'},
				id_grupo:1,
				grid:true,
				egrid:true,
				form:true
		},
		{
			config:{
				name: 'autor',
				fieldLabel: 'Autor', 
				qtip:'Introduzca el nombre del autor del respectivo libro.',
				regex : /^[a-zA-Z\s]+$/,
				regexText : 'Este campo solo permite el ingreso de letras A-Z',
				allowBlank: false,
				anchor: '85%',
				gwidth: 80,
				emptyText: 'Introduzca un nombre de autor...',
				maxLength:50
			},
				type:'TextField',
				filters:{pfiltro:'herr.autor',type:'string'},
				id_grupo:1,
				grid:true,
				egrid:true,
				form:true
		},
		{
			config:{
				name: 'contenido',
				fieldLabel: 'Contenido',
				qtip:'Introduzca un resumen o indice del contexto del libro.',
				regex : /^[a-zA-Z\s]+$/,
				regexText : 'Este campo solo permite el ingreso de letras A-Z',
				allowBlank: false,
				anchor: '85%',
				gwidth: 100,
				emptyText: 'Introduzca un contexto del contenido...',
				maxLength:100
			},
				type:'TextArea',
				filters:{pfiltro:'herr.contenido',type:'string'},
				id_grupo:1,
				grid:true,
				egrid:true,
				form:true
		},
		
		{
			config:{
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'herr.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creaciÃ³n',
				allowBlank: true,
				anchor: '80%',
				gwidth: 110,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'herr.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_reg',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu1.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'herr.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'usr_mod',
				fieldLabel: 'Modificado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu2.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_mod',
				fieldLabel: 'Fecha Modif.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'herr.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	//fileUpload:true,
	tam_pag:50,	
	title:'Herramienta',
	ActSave:'../../sis_biblioteca/control/Herramienta/insertarHerramienta',
	ActDel:'../../sis_biblioteca/control/Herramienta/eliminarHerramienta',
	ActList:'../../sis_biblioteca/control/Herramienta/listarHerramienta',
	id_store:'id_herramienta',
	fields: [
		{name:'id_herramienta', type: 'numeric'},
		{name:'desc_categoria', type: 'string'},
		{name:'id_categoria', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'enlace', type: 'string'},
		{name:'vigencia_licencia', type: 'date',dateFormat:'Y-m-d'},
		{name:'tipo', type: 'string'},
		{name:'autor', type: 'string'},
		{name:'contenido', type: 'string'},
		{name:'titulo', type: 'string'},
		{name:'licencia', type: 'string'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
	],
	sortInfo:{
		field: 'id_herramienta',
		direction: 'ASC'
	},
	bdel:true,
	bsave:true,
	iniciarEventos: function() {
		this.cmpHerramienta = this.getComponente('id_herramienta');
		this.cmpCategoria = this.getComponente('id_categoria');
		this.cmpTitulo = this.getComponente('titulo');
	    this.cmpAutor =this.getComponente('autor');
	    this.cmpContenido =this.getComponente('contenido');
	    this.cmpTipo =this.getComponente('tipo');
	    this.cmpEnlace =this.getComponente('enlace');
	    this.cmpLicencia =this.getComponente('licencia');
	    this.cmpVigenciaLicencia =this.getComponente('vigencia_licencia');
		this.cmpTipo.on('select',function(c,r,i){
	  		if (r.data.field1 == 'libro') {
			   	this.ocultarComponente(this.cmpLicencia);
			   	this.ocultarComponente(this.cmpVigenciaLicencia);
			   	this.mostrarComponente(this.cmpTitulo);
			   	this.mostrarComponente(this.cmpAutor);
			    this.mostrarComponente(this.cmpContenido);
			} else {
			   	this.ocultarComponente(this.cmpAutor);
			   	this.ocultarComponente(this.cmpContenido);
			   	this.mostrarComponente(this.cmpTitulo);
			   	this.mostrarComponente(this.cmpLicencia);
			   	this.mostrarComponente(this.cmpVigenciaLicencia);   	
	 		}
	   },this);
	 },	
	 onButtonSubirArchivo : function() {                   
        var rec=this.sm.getSelected();
        Phx.CP.loadWindows('../../../sis_biblioteca/vista/herramienta/SubirArchivo.php',
        'Subir archivos - Biblioteca Virtual',
        {
            modal:true,
            width:450,
            height:200
        },rec,this.idContenedor,'SubirArchivo')
    },
     preparaMenu:function()
    {	var rec = this.sm.getSelected();
        this.desactivarMenu();         
        this.getBoton('btnSubirArchivos').enable();          
        Phx.vista.Herramienta.superclass.preparaMenu.call(this);
    },
    desactivarMenu:function() {
    	this.getBoton('btnSubirArchivos').disable();    	
    },
      
	}
)
</script>
		
		