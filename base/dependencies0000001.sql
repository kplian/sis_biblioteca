/***********************************I-DEP-JKCC-BIBL-0-05/02/2015****************************************/
-- Reference:  asignacion_herramienta (table: asignacion)
ALTER TABLE bibl.tasignacion 
 ADD CONSTRAINT fk_tasignacion_therramienta FOREIGN KEY (id_asignacion)
    REFERENCES bibl.therramienta (id_herramienta)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE;

-- Reference:  herramienta_categoria (table: herramienta)
ALTER TABLE bibl.therramienta 
 ADD CONSTRAINT fk_therramienta_tcategoria FOREIGN KEY (categoria_idCategoria)
    REFERENCES bibl.tcategoria (idCategoria)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE;
/***********************************F-DEP-JKCC-BIBL-0-05/02/2015****************************************/