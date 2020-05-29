CREATE OR REPLACE FUNCTION ciudades_artistas (_artistas INT[])
RETURNS TABLE(ciudad VARCHAR(255)) AS
$$
DECLARE
    _aid INT;
BEGIN
FOREACH _aid IN ARRAY _artistas LOOP
    RETURN QUERY (SELECT DISTINCT C.ciudad AS ciudad FROM Pinto AS P, Obras AS O, Lugares AS L, Ciudades AS C WHERE _aid = P.aid AND P.oid = O.oid AND O.lid = L.lid AND L.cid = C.cid);
END LOOP;
RETURN;
END;
$$ LANGUAGE plpgsql;