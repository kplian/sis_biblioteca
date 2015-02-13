<?php
/**
*@package pXP
*@file gen-Asignacion.php
*@author  (admin)
*@date 11-02-2015 13:04:07
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.Asignacion=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.Asignacion.superclass.constructor.call(this,config);
		this.init();
		this.iniciarEventos();
		this.load({params:{start:0, limit:this.tam_pag}})
	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_asignacion'
			},
			type:'Field',
			form:true 
		},
		{
			config:{
				name: 'fecha_prestamo',
				fieldLabel: 'Fecha de Prestamo',
				qtip:'Seleccione la fecha actual de prestamo del respectivo libro.',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
				type:'DateField',
				filters:{pfiltro:'asig.fecha_prestamo',type:'date'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config: {
				name: 'id_herramienta',
				fieldLabel: 'Herramienta',
				qtip:'Seleccione la respectiva herramienta que quiere asignar.',
				allowBlank: false,
				emptyText: 'Seleccione una herramienta...',
				store: new Ext.data.JsonStore({
					url: '../../sis_biblioteca/control/Herramienta/listarHerramienta',
					id: 'id_herramientas',
					root: 'datos',
					sortInfo: {
						field: 'id_herramienta',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_herramienta', 'nombre', 'titulo', 'tipo','codigo'],
					remoteSort: true,
					baseParams: {par_filtro: 'movtip.nombre#movtip.codigo'}
				}),
				valueField: 'id_herramienta',
				displayField: 'titulo',
				gdisplayField: 'desc_herramienta',
				hiddenName: 'id_herramienta',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '80%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['desc_herramienta']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'movtip.nombre',type: 'string'},
			grid: true,
			form: true
		},
		{
   			config:{
       		    name:'id_funcionario',
       		    hiddenName: 'id_funcionario',
   				origen:'FUNCIONARIOCAR',
   				fieldLabel:'Funcionario',
   				allowBlank:false,
                gwidth:200,
                anchor: '80%',
   				valueField: 'id_funcionario',
   			    gdisplayField: 'desc_funcionario2',
   			    baseParams: { es_combo_solicitud : 'si' },
      			renderer:function(value, p, record){return String.format('{0}', record.data['desc_funcionario2']);}
       	     },
   			type:'ComboRec',//ComboRec
   			id_grupo:0,
   			filters:{pfiltro:'fun.desc_funcionario2',type:'string'},
   		    grid:true,
   			form:true
		 },
		/*{
			config: {
				name: 'id_funcionario',
				fieldLabel: 'Funcionario',
				qtip:'Selecione de la lista desplegable un respectivo funcionario al que quiere asiganar.',
				allowBlank: false,
				emptyText: 'Seleccione un funcionario...',
				store: new Ext.data.JsonStore({
					url: '../../sis_seguridad/control/Persona/listarPersona',
					id: 'id_persona',
					root: 'datos',
					sortInfo: {
						field: 'nombre_completo1',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_persona', 'nombre_completo1', 'ci'],
					remoteSort: true,
					baseParams: {par_filtro: 'p.nombre_completo1#p.ci'}
				}),
				valueField: 'id_persona',
				displayField: 'nombre_completo1',
				gdisplayField: 'desc_funcionario',
				tpl:'<tpl for="."><div class="x-combo-list-item"><p>{nombre_completo1}</p> </div></tpl>',
	       		hiddenName: 'id_funcionario',
	       		forceSelection:true,
	       		typeAhead: true,
	           	triggerAction: 'all',
	           	lazyRender:true,
	       		mode:'remote',
	       		pageSize:10,		
				queryDelay: 1000,
				anchor: '80%',
				width:250,
	       		gwidth:280,
	       		minChars:2,
	       		turl:'../../../sis_seguridad/vista/persona/Persona.php',
	       		ttitle:'Personas',
	       		tdata:{},
	       		tcls:'persona',
	       		pid:this.idContenedor,
				renderer : function(value, p, record) {return String.format('{0}', record.data['desc_funcionario']);}
			},
			type: 'TrigguerCombo',
			id_grupo: 0,
			filters: {
						pfiltro: 'nombre_completo1',
						type: 'string'
					 },
			grid: true,
			form: true
		},*/
		{
			config:{
				name: 'fecha_devolucion',
				fieldLabel: 'Fecha de Devolucion',
				qtip:'Seleccione la respectiva fecha de devolución del respectivo libro.',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
				type:'DateField',
				filters:{pfiltro:'asig.fecha_devolucion',type:'date'},
				id_grupo:1,
				grid:true,
				form:true
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
				filters:{pfiltro:'asig.estado_reg',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'observaciones',
				fieldLabel: 'Observaciones',
				qtip:'Introduzca una pequeña observación.',
				regex : /^[a-zA-Z\s]+$/,
				regexText : 'Este campo solo permite el ingreso de letras A-Z',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:100
			},
				type:'TextArea',
				filters:{pfiltro:'asig.observaciones',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: '',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'asig.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
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
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'asig.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'asig.fecha_reg',type:'date'},
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
				filters:{pfiltro:'asig.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
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
		}
	],
	tam_pag:50,	
	title:'Asignacion',
	ActSave:'../../sis_biblioteca/control/Asignacion/insertarAsignacion',
	ActDel:'../../sis_biblioteca/control/Asignacion/eliminarAsignacion',
	ActList:'../../sis_biblioteca/control/Asignacion/listarAsignacion',
	id_store:'id_asignacion',
	fields: [
		{name:'desc_herramienta', type: 'string'},
		{name:'desc_funcionario', type: 'string'},
		{name:'id_asignacion', type: 'numeric'},
		{name:'id_herramienta', type: 'numeric'},
		{name:'fecha_prestamo', type: 'date',dateFormat:'Y-m-d'},
		{name:'id_funcionario', type: 'numeric'},
		{name:'fecha_devolucion', type: 'date',dateFormat:'Y-m-d'},
		{name:'estado_reg', type: 'string'},
		{name:'observaciones', type: 'string'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		{name:'desc_funcionario2', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_asignacion',
		direction: 'ASC'
	},
	bdel:true,
	//bsave:true,
	iniciarEventos : function() {
		this.cmpFechaPrestamo = this.getComponente('fecha_prestamo');
		this.cmpFechaDevolucion = this.getComponente('fecha_devolucion');
		this.cmpObservaciones = this.getComponente('observaciones');
	    this.cmpHerramienta =this.getComponente('id_herramienta');
	    this.cmpFechaPrestamo.on('blur',function(){
	    	this.Cmp.id_funcionario.reset();
	    	this.Cmp.id_funcionario.modificado=true;
	    	this.Cmp.id_funcionario.store.baseParams.fecha = this.cmpFechaPrestamo.getValue().dateFormat(this.cmpFechaPrestamo.format);
	    },this);
	    
		this.Cmp.id_herramienta.on('select',function(c,r,i) {
			if (r.data.tipo == 'software') {
				this.ocultarComponente(this.cmpFechaPrestamo);
				this.ocultarComponente(this.cmpFechaDevolucion);
				this.mostrarComponente(this.cmpObservaciones);
			} else {
				this.mostrarComponente(this.cmpFechaPrestamo);
				this.mostrarComponente(this.cmpFechaDevolucion);
				this.mostrarComponente(this.cmpObservaciones);
			}
		},this);
	},
	}
)
</script>
		
		