CREATE OR REPLACE FUNCTION ciudades_artistas (_artistas INT[])
RETURNS TABLE(ciudad VARCHAR(255)) AS
$$
DECLARE
    _aid INT;
BEGIN
CREATE TEMP TABLE cities(ciudad VARCHAR(255));
FOREACH _aid IN ARRAY _artistas LOOP
    SELECT * FROM cities
    UNION
    SELECT DISTINCT C.ciudad AS ciudad FROM Pinto AS P, Obras AS O, Lugares AS L, Ciudades AS C WHERE _aid = P.aid AND P.oid = O.oid AND O.lid = L.lid AND L.cid = C.cid;
END LOOP;
RETURN(SELECT * FROM cities);
RETURN;
DROP TABLE cities;
END;
$$ LANGUAGE plpgsql;