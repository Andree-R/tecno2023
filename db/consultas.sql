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

CREATE VIEW v_conceptos_pago as
SELECT
cp.id,
cp.nombre,
cp.monto,
cc.descripcion as idCta
from conceptos_pago as cp
INNER JOIN ctas_contables cc
ON cc.id = cp.idCta