CREATE OR REPLACE FUNCTION itinerario (_artistas INT[], _fecha DATE, _origen INT)
RETURNS TABLE(itinerario INT, origen VARCHAR(255), destino VARCHAR(255), medio VARCHAR(255), h_salida TIME, duracion INT, precio FLOAT) AS
$$
DECLARE
    _ciudad RECORD;
    _c_origen RECORD;
    _precio_total FLOAT;
    _v1 RECORD;
    _v2 RECORD;
    _v3 RECORD;
    _itinerario INT;
    _datos RECORD;
    _aid INT;
BEGIN
    DROP TABLE IF EXISTS c_visitables;
    CREATE TEMPORARY TABLE c_visitables (ciudad VARCHAR(255));
    FOREACH _aid IN ARRAY _artistas LOOP
        INSERT INTO c_visitables (ciudad) SELECT DISTINCT C.ciudad AS ciudad FROM Pinto AS P, Obras AS O, Lugares AS L, Ciudades AS C WHERE _aid = P.aid AND P.oid = O.oid AND O.lid = L.lid AND L.cid = C.cid;
    END LOOP;

    _precio_total := 0;
    _itinerario := 1;
    DROP TABLE IF EXISTS I;
    CREATE TEMPORARY TABLE I (_itinerario INT, origen VARCHAR(255), destino VARCHAR(255), medio VARCHAR(255), h_salida TIME, duracion INT, precio FLOAT);
    FOR _v1 IN (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE o_cid = _origen AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) LOOP
        CASE WHEN EXISTS (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE _v1.d_cid = o_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) THEN
            FOR _v2 IN (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE _v1.d_cid = o_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) LOOP
                CASE WHEN EXISTS (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE _v2.d_cid = o_cid AND _v2.o_cid <> d_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) THEN
                    FOR _v3 IN (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE _v2.d_cid = o_cid AND _v2.o_cid <> d_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) LOOP
                        FOR _datos IN (SELECT C1.ciudad AS origen1, C2.ciudad AS destino1, V.medio AS medio1, V.h_salida AS hora1, V.duracion AS duracion1, V.precio AS precio1 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v1.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid) LOOP
                            INSERT INTO I VALUES(_itinerario, _datos.origen1, _datos.destino1, _datos.medio1, _datos.hora1, _datos.duracion1, _datos.precio1);
                        END LOOP;
                        FOR _datos IN (SELECT C1.ciudad AS origen2, C2.ciudad AS destino2, V.medio AS medio2, V.h_salida AS hora2, V.duracion AS duracion2, V.precio AS precio2 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v2.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid) LOOP
                            INSERT INTO I VALUES(_itinerario, _datos.origen2, _datos.destino2, _datos.medio2, _datos.hora2, _datos.duracion2, _datos.precio2);
                        END LOOP;
                        FOR _datos IN (SELECT C1.ciudad AS origen3, C2.ciudad AS destino3, V.medio AS medio3, V.h_salida AS hora3, V.duracion AS duracion3, V.precio AS precio3 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v3.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid) LOOP
                            INSERT INTO I VALUES(_itinerario, _datos.origen3, _datos.destino3, _datos.medio3, _datos.hora3, _datos.duracion3, _datos.precio3);
                            _itinerario = _itinerario + 1;
                        END LOOP;
                    END LOOP;
                ELSE
                
                END CASE;
                FOR _datos IN (SELECT C1.ciudad AS origen1, C2.ciudad AS destino1, V.medio AS medio1, V.h_salida AS hora1, V.duracion AS duracion1, V.precio AS precio1 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v1.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid) LOOP
                    INSERT INTO I VALUES(_itinerario, _datos.origen1, _datos.destino1, _datos.medio1, _datos.hora1, _datos.duracion1, _datos.precio1);
                END LOOP;
                FOR _datos IN (SELECT C1.ciudad AS origen2, C2.ciudad AS destino2, V.medio AS medio2, V.h_salida AS hora2, V.duracion AS duracion2, V.precio AS precio2 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v2.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid) LOOP
                    INSERT INTO I VALUES(_itinerario, _datos.origen2, _datos.destino2, _datos.medio2, _datos.hora2, _datos.duracion2, _datos.precio2);
                    _itinerario = _itinerario + 1;
                END LOOP;
            END LOOP;
        ELSE

        END CASE;
        FOR _datos IN (SELECT C1.ciudad AS origen1, C2.ciudad AS destino1, V.medio AS medio1, V.h_salida AS hora1, V.duracion AS duracion1, V.precio AS precio1 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v1.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid) LOOP
            INSERT INTO I VALUES(_itinerario, _datos.origen1, _datos.destino1, _datos.medio1, _datos.hora1, _datos.duracion1, _datos.precio1);
            _itinerario = _itinerario + 1;
        END LOOP;
    END LOOP;

    RETURN QUERY SELECT * FROM I;
RETURN;
END;
$$ LANGUAGE plpgsql;