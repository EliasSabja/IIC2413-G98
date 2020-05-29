CREATE OR REPLACE FUNCTION ciudades_artista (_aid INTEGER)
RETURNS TABLE(ciudad VARCHAR(255)) AS
$$
BEGIN
RETURN QUERY SELECT DISTINCT C.ciudad FROM Pinto AS P, Obras AS O, Lugares AS L, Ciudades AS C WHERE _aid = P.aid AND P.oid = O.oid AND O.lid = L.lid AND L.cid = C.cid;
RETURN;
END;
$$ LANGUAGE plpgsql;