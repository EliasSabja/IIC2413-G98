CREATE OR REPLACE FUNCTION itinerario (_artistas INT[], _fecha DATE, _origen VARCHAR(255))
RETURNS TABLE(itinerario INT, precio_total FLOAT, origen VARCHAR(255), destino VARCHAR(255), medio VARCHAR(255), hora_salida TIME, duracion INT, precio FLOAT) AS
$$
DECLARE
    _ciudad RECORD;
BEGIN
    SELECT vid FROM VOD WHERE o_cid = _origen;
    FOR _ciudad IN ciudades_artistas(_artistas) LOOP
    END LOOP;

    RETURN QUERY SELECT DISTINCT C.ciudad FROM Pinto AS P, Obras AS O, Lugares AS L, Ciudades AS C WHERE _aid = P.aid AND P.oid = O.oid AND O.lid = L.lid AND L.cid = C.cid;
RETURN;
END;
$$ LANGUAGE plpgsql;