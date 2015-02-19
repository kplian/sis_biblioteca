/***********************************I-SCP-JKCC-BIBL-0-05/02/2015****************************************/
CREATE TABLE bibl.tasignacion (
    id_asignacion serial  NOT NULL,
    fecha_prestamo date  NOT NULL,
    id_funcionario int  NOT NULL,
    fecha_devolucion date  NOT NULL,
    cantidad int  NOT NULL,
    observaciones text  NOT NULL,
    id_herramienta int  NOT NULL,
    CONSTRAINT asignacion_pk PRIMARY KEY (id_asignacion)
)INHERITS (pxp.tbase)
WITHOUT OIDS;

CREATE TABLE bibl.tcategoria (
    id_categoria serial  NOT NULL,
    nombre_categoria varchar(50)  NOT NULL,
    CONSTRAINT categoria_pk PRIMARY KEY (id_categoria)
)INHERITS (pxp.tbase)
WITHOUT OIDS;

CREATE TABLE bibl.therramienta (
    id_herramienta serial  NOT NULL,
    titulo varchar(100)  NOT NULL,
    autor varchar(50)  NOT NULL,
    contenido varchar(512)  NOT NULL,
    tipo varchar(50)  NOT NULL,
    enlace varchar(512)  NOT NULL,
    licencia varchar(512)  NOT NULL,
    vigencia_licencia date  NOT NULL,
    id_categoria int  NOT NULL,
    CONSTRAINT herramienta_pk PRIMARY KEY (id_herramienta)
)INHERITS (pxp.tbase)
WITHOUT OIDS;

/***********************************F-SCP-JKCC-BIBL-0-05/02/2015****************************************/

/***********************************I-SCP-JKCC-BIBL-0-11/02/2015****************************************/
ALTER TABLE bibl.tasignacion DROP COLUMN cantidad;
/***********************************F-SCP-JKCC-BIBL-0-11/02/2015****************************************/

/***********************************I-SCP-JKCC-BIBL-1-11/02/2015****************************************/
ALTER TABLE bibl.therramienta ALTER COLUMN vigencia_licencia DROP NOT NULL;
/***********************************F-SCP-JKCC-BIBL-1-11/02/2015****************************************/

/***********************************I-SCP-JKCC-BIBL-1-12/02/2015****************************************/
ALTER TABLE bibl.tasignacion ALTER COLUMN fecha_prestamo DROP NOT NULL;
ALTER TABLE bibl.tasignacion ALTER COLUMN fecha_devolucion DROP NOT NULL;
/***********************************F-SCP-JKCC-BIBL-1-12/02/2015****************************************/

/***********************************I-SCP-JKCC-BIBL-0-13/02/2015****************************************/
ALTER TABLE bibl.therramienta ALTER COLUMN enlace DROP NOT NULL;
/***********************************F-SCP-JKCC-BIBL-0-13/02/2015****************************************/

/***********************************I-SCP-JKCC-BIBL-0-19/02/2015****************************************/
ALTER TABLE bibl.therramienta ALTER COLUMN contenido DROP NOT NULL;
/***********************************F-SCP-JKCC-BIBL-0-19/02/2015****************************************/

