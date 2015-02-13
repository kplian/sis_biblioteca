<?php
/**
*@package pXP
*@file    SubirArchivo.php
*@author  Jhonerex 
*@date    13-02-2015
*@description permites subir archivos a la tabla de documento_sol
*/
header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.SubirArchivo=Ext.extend(Phx.frmInterfaz,{
    //ActSave:'../../sis_bibliotecario/control/Herramienta/modificarColumna',
	ActSave:'../../sis_planillas/control/ColumnaValor/modificarColumnaCsv',
    constructor:function(config)
    {   
        Phx.vista.SubirArchivo.superclass.constructor.call(this,config);
        this.init();    
        this.loadValoresIniciales();
        this.getComponente('enlace').store.setBaseParam('enlace',this.enlace);       
        
    },
    
    loadValoresIniciales:function()
    {        
        Phx.vista.SubirArchivo.superclass.loadValoresIniciales.call(this);
        this.getComponente('id_herramienta').setValue(this.id_herramienta);     
    },
    
    successSave:function(resp)
    {
        Phx.CP.loadingHide();
        Phx.CP.getPagina(this.idContenedorPadre).reload();
        this.panel.close();
    },
                
    
    Atributos:[
        {
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
            	name: 'archivo',
                fieldLabel: "Documento (archivo pdf - doc - exe)",
                gwidth: 130,
                qtip:'Seleccione el archivo correspondiente a la herramienta.',
                inputType:'file',
                buttonText: '', 
                maxLength:150,
                anchor:'100%'                   
            },
            type:'Field',
            form:true 
        },      
    ],
    tam_pag:50,
    id_store:'id_herramienta',
    title:'Subir Archivo',    
    fileUpload:true
    
}
)    
</script>