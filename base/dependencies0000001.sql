/***********************************I-DEP-JKCC-BIBL-0-05/02/2015****************************************/
-- Reference:  asignacion_herramienta (table: asignacion)
ALTER TABLE bibl.tasignacion 
 ADD CONSTRAINT tasignacion_therramienta FOREIGN KEY (id_herramienta)
    REFERENCES bibl.therramienta (id_herramienta)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE;

-- Reference:  herramienta_categoria (table: herramienta)
ALTER TABLE bibl.therramienta 
 ADD CONSTRAINT therramienta_tcategoria FOREIGN KEY (id_categoria)
    REFERENCES bibl.tcategoria (id_categoria)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE;
/***********************************F-DEP-JKCC-BIBL-0-05/02/2015****************************************/