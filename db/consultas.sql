CREATE VIEW v_documentos AS
SELECT 
doc.id,
docR.numero as idDocumento,
doc.numero,
doc.asunto,
doc.fecha,
doc.descripcion,
doc.fecha_recepcion,
tipDoc.tipo as idTipo,
ofic.nombre as idOficina,
CONCAT(person.nombres," ",person.apellidos) as idPersona
FROM documentos doc 
INNER JOIN documentos docR 
ON doc.id = docR.id 
INNER JOIN tipos_documentos tipDoc 
ON tipDoc.id = doc.idTipo 
INNER JOIN personas person 
ON person.id = doc.idPersona 
INNER JOIN oficinas ofic 
ON ofic.id = doc.idOficina
;

CREATE VIEW v_conceptos_pago as
SELECT
cp.id,
cp.nombre,
cp.monto,
cc.descripcion as idCta
from conceptos_pago cp
INNER JOIN ctas_contables cc
ON cc.id = cp.idCta
;

CREATE VIEW v_estudiante AS
SELECT
p.*,
e.idPrograma_estudios,
pe.nombre as programa
from estudiantes e
INNER JOIN personas p
ON p.id = e.id
INNER JOIN programas_estudios pe
ON pe.id = e.idPrograma_estudios
;

CREATE VIEW v_anexoDocumento as
SELECT 
ad.id,
ad.nombre,
ad.descripcion,
ad.url,
d.numero as idDocumento
from anexos_documento ad
INNER join documentos d
on d.id = ad.idDocumento
;

CREATE VIEW v_oficinas as
SELECT
of.*,
ofG.nombre as matriz,
sp.idCargo,
CONCAT(p.nombres," ",p.apellidos) as jefe
from oficinas of
LEFT JOIN oficinas ofG
ON ofG.id = of.idOficina
LEFT JOIN servidores_publicos sp
ON sp.id = of.idJefe
LEFT JOIN personas p 
ON p.id = sp.id
;

CREATE VIEW v_tramites_documentarios as
SELECT
td.*,
d.numero,
d.idDocumento,
d.asunto,
ofo.nombre as oficinaOrigen,
ofd.nombre as oficinaDestino,
et.estado
FROM tramites_documentarios td
INNER JOIN documentos d
ON d.id = td.idDocumento
INNER JOIN oficinas ofo
ON ofo.id = td.idOficinaOrigen
INNER JOIN oficinas ofd
ON ofd.id = td.idOficinaDestino
INNER JOIN estados_tramites et
ON et.id = td.idEstado
;

CREATE VIEW v_servidores_publicos as
SELECT
p.*,
sp.idCargo,
c.nombre as cargo
from servidores_publicos sp
INNER JOIN personas p
ON p.id = sp.id
INNER JOIN cargos c
ON c.id = sp.idCargo
;