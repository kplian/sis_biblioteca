CREATE OR REPLACE FUNCTION "bibl"."ft_herramienta_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Sistema Bibliotecario
 FUNCION: 		bibl.ft_herramienta_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'bibl.therramienta'
 AUTOR: 		 (admin)
 FECHA:	        05-02-2015 21:57:48
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
	v_id_herramienta	integer;
			    
BEGIN

    v_nombre_funcion = 'bibl.ft_herramienta_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'BIBLIO_HERR_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		05-02-2015 21:57:48
	***********************************/

	if(p_transaccion='BIBLIO_HERR_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into bibl.therramienta(
			id_categoria,
			estado_reg,
			vigencia_licencia,
			tipo,
			autor,
			contenido,
			titulo,
			licencia,
			usuario_ai,
			fecha_reg,
			id_usuario_reg,
			id_usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			v_parametros.id_categoria,
			'activo',
			v_parametros.vigencia_licencia,
			v_parametros.tipo,
			v_parametros.autor,
			v_parametros.contenido,
			v_parametros.titulo,
			v_parametros.licencia,
			v_parametros._nombre_usuario_ai,
			now(),
			p_id_usuario,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_herramienta into v_id_herramienta;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Herramienta almacenado(a) con exito (id_herramienta'||v_id_herramienta||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_herramienta',v_id_herramienta::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_HERR_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		05-02-2015 21:57:48
	***********************************/

	elsif(p_transaccion='BIBLIO_HERR_MOD')then

		begin
			--Sentencia de la modificacion
			update bibl.therramienta set
			id_categoria = v_parametros.id_categoria,
			vigencia_licencia = v_parametros.vigencia_licencia,
			tipo = v_parametros.tipo,
			autor = v_parametros.autor,
			contenido = v_parametros.contenido,
			titulo = v_parametros.titulo,
			licencia = v_parametros.licencia,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_herramienta=v_parametros.id_herramienta;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Herramienta modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_herramienta',v_parametros.id_herramienta::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_HERR_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		05-02-2015 21:57:48
	***********************************/

	elsif(p_transaccion='BIBLIO_HERR_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from bibl.therramienta
            where id_herramienta=v_parametros.id_herramienta;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Herramienta eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_herramienta',v_parametros.id_herramienta::varchar);
              
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
ALTER FUNCTION "bibl"."ft_herramienta_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
