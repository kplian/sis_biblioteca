CREATE OR REPLACE FUNCTION "bibl"."ft_asignacion_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema Bibliotecario
 FUNCION: 		bibl.ft_asignacion_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'bibl.tasignacion'
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

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'bibl.ft_asignacion_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'BIBLIO_ASIG_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		admin	
 	#FECHA:		10-02-2015 21:48:19
	***********************************/

	if(p_transaccion='BIBLIO_ASIG_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						asig.id_asignacion,
						asig.id_herramienta,
						asig.fecha_prestamo,
						asig.id_funcionario,
						asig.fecha_devolucion,
						asig.estado_reg,
						asig.observaciones,
						asig.id_usuario_ai,
						asig.id_usuario_reg,
						asig.usuario_ai,
						asig.fecha_reg,
						asig.fecha_mod,
						asig.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
						herr1.titulo as desc_herramienta,
						fun1.desc_funcionario1 as desc_funcionario2
						from bibl.tasignacion asig
						inner join orga.vfuncionario fun1 on fun1.id_funcionario = asig.id_funcionario
						inner join bibl.therramienta herr1 on herr1.id_herramienta = asig.id_herramienta
						inner join segu.tusuario usu1 on usu1.id_usuario = asig.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = asig.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'BIBLIO_ASIG_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		admin	
 	#FECHA:		10-02-2015 21:48:19
	***********************************/

	elsif(p_transaccion='BIBLIO_ASIG_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_asignacion)
					    from bibl.tasignacion asig
					    inner join segu.tusuario usu1 on usu1.id_usuario = asig.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = asig.id_usuario_mod
					    where ';
			
			--Definicion de la respuesta		    
			v_consulta:=v_consulta||v_parametros.filtro;

			--Devuelve la respuesta
			return v_consulta;

		end;
					
	else
					     
		raise exception 'Transaccion inexistente';
					         
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
ALTER FUNCTION "bibl"."ft_asignacion_sel"(integer, integer, character varying, character varying) OWNER TO postgres; 