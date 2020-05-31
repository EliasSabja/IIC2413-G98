CREATE OR REPLACE FUNCTION itinerario (_artistas INT[], _fecha DATE, _origen INT)
RETURNS TABLE(itinerario INT, precio_total FLOAT, fecha DATE, origen VARCHAR(255), destino VARCHAR(255), medio VARCHAR(255), h_salida TIME, duracion INT, precio FLOAT) AS
$$
DECLARE
    _fecha_actual DATE;
    _precio_total FLOAT;
    _v1 RECORD;
    _v2 RECORD;
    _v3 RECORD;
    _itinerario INT;
    _datos1 RECORD;
    _datos2 RECORD;
    _datos3 RECORD;
    _aid INT;
    _duracion INTERVAL;
    _dia INT;
BEGIN
    DROP TABLE IF EXISTS c_visitables;
    CREATE TEMPORARY TABLE c_visitables (ciudad VARCHAR(255));
    FOREACH _aid IN ARRAY _artistas LOOP
        INSERT INTO c_visitables (ciudad) SELECT DISTINCT C.ciudad AS ciudad FROM Pinto AS P, Obras AS O, Lugares AS L, Ciudades AS C WHERE _aid = P.aid AND P.oid = O.oid AND O.lid = L.lid AND L.cid = C.cid;
    END LOOP;

    _precio_total := 0;
    _itinerario := 1;
    _dia := 1;
    DROP TABLE IF EXISTS I;
    CREATE TEMPORARY TABLE I (itinerario INT, precio_total FLOAT, fecha DATE, origen VARCHAR(255), destino VARCHAR(255), medio VARCHAR(255), h_salida TIME, duracion INT, precio FLOAT);
    FOR _v1 IN (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE o_cid = _origen AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) LOOP
        CASE WHEN EXISTS (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE _v1.d_cid = o_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) THEN
            FOR _v2 IN (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE _v1.d_cid = o_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) LOOP
                CASE WHEN EXISTS (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE _v2.d_cid = o_cid AND _v2.o_cid <> d_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) THEN
                    FOR _v3 IN (SELECT * FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD WHERE _v2.d_cid = o_cid AND _v2.o_cid <> d_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM c_visitables AS CV, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C WHERE CV.ciudad = C.ciudad)) LOOP
                        SELECT C1.ciudad AS origen1, C2.ciudad AS destino1, V.medio AS medio1, V.h_salida AS hora1, V.duracion AS duracion1, V.precio AS precio1 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v1.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid INTO _datos1;
                        SELECT C1.ciudad AS origen2, C2.ciudad AS destino2, V.medio AS medio2, V.h_salida AS hora2, V.duracion AS duracion2, V.precio AS precio2 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v2.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid INTO _datos2;
                        SELECT C1.ciudad AS origen3, C2.ciudad AS destino3, V.medio AS medio3, V.h_salida AS hora3, V.duracion AS duracion3, V.precio AS precio3 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v3.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid INTO _datos3;
                        _precio_total := _datos1.precio1 + _datos2.precio2 + _datos3.precio3;
                        INSERT INTO I VALUES(_itinerario, _precio_total, _fecha, _datos1.origen1, _datos1.destino1, _datos1.medio1, _datos1.hora1, _datos1.duracion1, _datos1.precio1);
                        _fecha_actual := _fecha;
                        _duracion := make_interval(hours => _datos1.duracion1);
                        IF _datos1.hora1 + _duracion > _datos2.hora2 THEN
                            _fecha_actual := _fecha_actual + _dia;
                        ELSE NULL;
                        END IF;
                        INSERT INTO I VALUES(_itinerario, _precio_total, _fecha_actual, _datos2.origen2, _datos2.destino2, _datos2.medio2, _datos2.hora2, _datos2.duracion2, _datos2.precio2);
                        _duracion := make_interval(hours => _datos2.duracion2);
                        IF _datos2.hora2 + _duracion > _datos3.hora3 THEN
                            _fecha_actual := _fecha_actual + _dia;
                        ELSE NULL;
                        END IF;
                        INSERT INTO I VALUES(_itinerario, _precio_total, _fecha_actual, _datos3.origen3, _datos3.destino3, _datos3.medio3, _datos3.hora3, _datos3.duracion3, _datos3.precio3);
                        _itinerario := _itinerario + 1;
                    END LOOP;
                ELSE NULL;              
                END CASE;
                SELECT C1.ciudad AS origen1, C2.ciudad AS destino1, V.medio AS medio1, V.h_salida AS hora1, V.duracion AS duracion1, V.precio AS precio1 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v1.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid INTO _datos1;
                SELECT C1.ciudad AS origen2, C2.ciudad AS destino2, V.medio AS medio2, V.h_salida AS hora2, V.duracion AS duracion2, V.precio AS precio2 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v2.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid INTO _datos2;
                _precio_total := _datos1.precio1 + _datos2.precio2;
                INSERT INTO I VALUES(_itinerario, _precio_total, _fecha, _datos1.origen1, _datos1.destino1, _datos1.medio1, _datos1.hora1, _datos1.duracion1, _datos1.precio1);
                _fecha_actual := _fecha;
                _duracion := make_interval(hours => _datos1.duracion1);
                IF _datos1.hora1 + _duracion > _datos2.hora2 THEN
                    _fecha_actual := _fecha_actual + _dia;
                ELSE NULL;
                END IF;
                INSERT INTO I VALUES(_itinerario, _precio_total, _fecha_actual, _datos2.origen2, _datos2.destino2, _datos2.medio2, _datos2.hora2, _datos2.duracion2, _datos2.precio2);
                _itinerario := _itinerario + 1;
            END LOOP;
        ELSE NULL;
        END CASE;
        SELECT C1.ciudad AS origen1, C2.ciudad AS destino1, V.medio AS medio1, V.h_salida AS hora1, V.duracion AS duracion1, V.precio AS precio1 FROM (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Viajes') AS V(vid INT, h_salida TIME, duracion INT, medio VARCHAR(50), capacidad INT, precio FLOAT)) AS V, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM VOD') AS VOD(vid INT, o_cid INT, d_cid INT)) AS VOD, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C1(cid INT, ciudad VARCHAR(50))) AS C1, (SELECT * FROM dblink('dbname=grupo99e2 user=grupo99 password=Soto314', 'SELECT * FROM Ciudades') AS C(cid INT, ciudad VARCHAR(50))) AS C2 WHERE V.vid = _v1.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid INTO _datos1;
        INSERT INTO I VALUES(_itinerario, _datos1.precio1, _fecha,_datos1.origen1, _datos1.destino1, _datos1.medio1, _datos1.hora1, _datos1.duracion1, _datos1.precio1);
        _itinerario := _itinerario + 1;
    END LOOP;
    RETURN QUERY SELECT * FROM I;
RETURN;
END;
$$ LANGUAGE plpgsql;