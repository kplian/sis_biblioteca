CREATE OR REPLACE FUNCTION "bibl"."ft_asignacion_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema Bibliotecario
 FUNCION: 		bibl.ft_asignacion_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'bibl.tasignacion'
 AUTOR: 		 (admin)
 FECHA:	        10-02-2015 21:48:19
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:

 DESCRIPCION:	
 AUTOR:			
 FECHA:		
***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_asignacion	integer;
			    
BEGIN

    v_nombre_funcion = 'bibl.ft_asignacion_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'BIBLIO_ASIG_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		10-02-2015 21:48:19
	***********************************/

	if(p_transaccion='BIBLIO_ASIG_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into bibl.tasignacion(
			id_herramienta,
			fecha_prestamo,
			id_funcionario,
			fecha_devolucion,
			estado_reg,
			observaciones,
			id_usuario_ai,
			id_usuario_reg,
			usuario_ai,
			fecha_reg,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.id_herramienta,
			v_parametros.fecha_prestamo,
			v_parametros.id_funcionario,
			v_parametros.fecha_devolucion,
			'activo',
			v_parametros.observaciones,
			v_parametros._id_usuario_ai,
			p_id_usuario,
			v_parametros._nombre_usuario_ai,
			now(),
			null,
			null
							
			
			
			)RETURNING id_asignacion into v_id_asignacion;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Asignacion almacenado(a) con exito (id_asignacion'||v_id_asignacion||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_asignacion',v_id_asignacion::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_ASIG_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		10-02-2015 21:48:19
	***********************************/

	elsif(p_transaccion='BIBLIO_ASIG_MOD')then

		begin
			--Sentencia de la modificacion
			update bibl.tasignacion set
			id_herramienta = v_parametros.id_herramienta,
			fecha_prestamo = v_parametros.fecha_prestamo,
			id_funcionario = v_parametros.id_funcionario,
			fecha_devolucion = v_parametros.fecha_devolucion,
			observaciones = v_parametros.observaciones,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_asignacion=v_parametros.id_asignacion;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Asignacion modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_asignacion',v_parametros.id_asignacion::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_ASIG_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		10-02-2015 21:48:19
	***********************************/

	elsif(p_transaccion='BIBLIO_ASIG_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from bibl.tasignacion
            where id_asignacion=v_parametros.id_asignacion;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Asignacion eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_asignacion',v_parametros.id_asignacion::varchar);
              
            --Devuelve la respuesta
            return v_resp;

		end;
         
	else
     
    	raise exception 'Transaccion inexistente: %',p_transaccion;

	end if;

EXCEPTION
				
	WHEN OTHERS THEN
		v_resp='';
		v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
		v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
		v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
		raise exception '%',v_resp;
				        
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "bibl"."ft_asignacion_ime"(integer, integer, character varying, character varying) OWNER TO postgres; 