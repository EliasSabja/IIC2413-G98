CREATE OR REPLACE FUNCTION itinerario (_artistas INT[], _fecha DATE, _origen INT)
RETURNS TABLE(ciudad VARCHAR(255)) AS
$$
DECLARE
    _ciudad RECORD;
    _v1 RECORD;
    _v2 RECORD;
    _v3 RECORD;
    _precio_total FLOAT;
    _itinerario INT;
    _datos RECORD;
    _aid INT;
    _c_origen RECORD;
BEGIN
    DROP TABLE IF EXISTS c_visitables;
    CREATE TEMPORARY TABLE c_visitables (ciudad VARCHAR(255));
    FOREACH _aid IN ARRAY _artistas LOOP
        INSERT INTO c_visitables (ciudad) SELECT DISTINCT C.ciudad AS ciudad FROM Pinto AS P, Obras AS O, Lugares AS L, Ciudades AS C WHERE _aid = P.aid AND P.oid = O.oid AND O.lid = L.lid AND L.cid = C.cid;
    END LOOP;

    RETURN QUERY SELECT * FROM c_visitables;
RETURN;
END;
$$ LANGUAGE plpgsql;