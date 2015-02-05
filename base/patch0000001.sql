/***********************************I-SCP-JKCC-BIBL-0-05/02/2015****************************************/
CREATE TABLE bibl.tasignacion (
    id_asignacion int  NOT NULL,
    fecha_prestamo date  NOT NULL,
    id_funcionario int  NOT NULL,
    fecha_devolucion date  NOT NULL,
    cantidad int  NOT NULL,
    observaciones text  NOT NULL,
    herramienta_id_herramienta int  NOT NULL,
    CONSTRAINT asignacion_pk PRIMARY KEY (id_asignacion)
)INHERITS (pxp.tbase)
WITHOUT OIDS;

CREATE TABLE bibl.tcategoria (
    idCategoria int  NOT NULL,
    nombreCategoria varchar(50)  NOT NULL,
    CONSTRAINT categoria_pk PRIMARY KEY (idCategoria)
)INHERITS (pxp.tbase)
WITHOUT OIDS;

CREATE TABLE bibl.therramienta (
    id_herramienta int  NOT NULL,
    titulo varchar(100)  NOT NULL,
    autor varchar(50)  NOT NULL,
    contenido text  NOT NULL,
    tipo varchar(50)  NOT NULL,
    enlace varchar(512)  NOT NULL,
    licencia varchar(512)  NOT NULL,
    vigencia_licencia date  NOT NULL,
    categoria_idCategoria int  NOT NULL,
    CONSTRAINT herramienta_pk PRIMARY KEY (id_herramienta)
)INHERITS (pxp.tbase)
WITHOUT OIDS;

/***********************************F-SCP-JKCC-BIBL-0-05/02/2015****************************************/