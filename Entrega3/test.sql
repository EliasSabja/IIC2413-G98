CREATE OR REPLACE FUNCTION ciudades_artista (aid INT)
RETURNS TABLE(ciudad VARCHAR(255) AS
$$
BEGIN
RETURN QUERY SELECT DISTINCT C.ciudad FROM Pinto AS P, Obras AS O, Lugares AS L, Ciudades AS C WHERE INPUT_AID = P.aid AND P.oid = O.oid AND O.lid = L.lid AND L.cid = C.cid;
RETURN;
END;
$$ LANGUAGE plpgsql;