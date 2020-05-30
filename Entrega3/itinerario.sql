CREATE OR REPLACE FUNCTION itinerario (_artistas INT[], _fecha DATE, _origen VARCHAR(255))
RETURNS TABLE(itinerario INT, precio_total FLOAT, fecha DATE, origen VARCHAR(255), destino VARCHAR(255), medio VARCHAR(255), hora_salida TIME, duracion INT, precio FLOAT) AS
$$
DECLARE
    _ciudad RECORD;
    _v1 RECORD;
    _v2 RECORD;
    _v3 RECORD;
    _precio_total FLOAT;
    _itinerario INT;
    _datos RECORD;
BEGIN
    DROP TABLE IF EXISTS c_visitables;
    CREATE TEMPORARY TABLE c_visitables (ciudad VARCHAR(255));
    INSERT INTO c_visitables(ciudad) SELECT ciudad FROM ciudades_artistas(_artistas);
    \c grupo99e2 grupo99

    precio_total := 0;
    itinerario := 1;
    DROP TABLE IF EXISTS I;
    CREATE TEMPORARY TABLE I (itinerario INT, origen VARCHAR(255), destino VARCHAR(255), medio VARCHAR(255), hora_salida TIME, duracion INT, precio FLOAT);
    FOR _v1 IN (SELECT * FROM VOD WHERE o_cid = _origen AND d_cid IN (SELECT DISTINCT C.cid FROM (SELECT * FROM dblink('dbname=grupo98e2 user=grupo98 password=perro123', 'SELECT * FROM c_visitables') AS FOO) AS CV, Ciudades AS C WHERE CV.nombre = C.nombre)) LOOP
        CASE WHEN EXISTS (SELECT * FROM VOD WHERE _v1.d_cid = o_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM (SELECT * FROM dblink('dbname=grupo98e2 user=grupo98 password=perro123', 'SELECT * FROM c_visitables') AS FOO) AS CV, Ciudades AS C WHERE CV.nombre = C.nombre)) THEN
            FOR _v2 IN (SELECT * FROM VOD WHERE _v1.d_cid = o_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM (SELECT * FROM dblink('dbname=grupo98e2 user=grupo98 password=perro123', 'SELECT * FROM c_visitables') AS FOO) AS CV, Ciudades AS C WHERE CV.nombre = C.nombre)) LOOP
                CASE WHEN EXISTS (SELECT * FROM VOD WHERE _v2.d_cid = o_cid AND _v2.o_cid <> d_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM (SELECT * FROM dblink('dbname=grupo98e2 user=grupo98 password=perro123', 'SELECT * FROM c_visitables') AS FOO) AS CV, Ciudades AS C WHERE CV.nombre = C.nombre)) THEN
                    FOR _v3 IN (SELECT * FROM VOD WHERE _v2.d_cid = o_cid AND _v2.o_cid <> d_cid AND _v1.o_cid <> d_cid AND d_cid IN (SELECT DISTINCT C.cid FROM (SELECT * FROM dblink('dbname=grupo98e2 user=grupo98 password=perro123', 'SELECT * FROM c_visitables') AS FOO) AS CV, Ciudades AS C WHERE CV.nombre = C.nombre)) LOOP
                        FOR _datos IN (SELECT C1.ciudad AS origen1, C2.ciudad AS destino1, V.medio AS medio1, V.hora_salida AS hora1, V.duracion AS duracion1, V.precio AS precio1 FROM Viajes AS V, VDO, Ciudades AS C1, Ciudades AS C2 WHERE V.vid = _v1.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD_d_cid = C2.cid) LOOP
                            INSERT INTO I VALUES(itinerario, _datos.origen1, _datos.destino1, _datos.medio1, _datos.hora1, _datos.duracion1, _datos.precio1);
                        END LOOP;
                        FOR _datos IN (SELECT C1.ciudad AS origen2, C2.ciudad AS destino2, V.medio AS medio2, V.hora_salida AS hora2, V.duracion AS duracion2, V.precio AS precio2 FROM Viajes AS V, VDO, Ciudades AS C1, Ciudades AS C2 WHERE V.vid = _v2.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD_d_cid = C2.cid) LOOP
                            INSERT INTO I VALUES(itinerario, _datos.origen2, _datos.destino2, _datos.medio2, _datos.hora2, _datos.duracion2, _datos.precio2);
                        END LOOP;
                        FOR _datos IN (SELECT C1.ciudad AS origen3, C2.ciudad AS destino3, V.medio AS medio3, V.hora_salida AS hora3, V.duracion AS duracion3, V.precio AS precio3 FROM Viajes AS V, VDO, Ciudades AS C1, Ciudades AS C2 WHERE V.vid = _v3.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD_d_cid = C2.cid) LOOP
                            INSERT INTO I VALUES(itinerario, _datos.origen3, _datos.destino3, _datos.medio3, _datos.hora3, _datos.duracion3, _datos.precio3);
                            itinerario = itinerario + 1;
                        END LOOP;
                    END LOOP;
                ElSE
                    FOR _datos IN (SELECT C1.ciudad AS origen2, C2.ciudad AS destino2, V.medio AS medio2, V.hora_salida AS hora2, V.duracion AS duracion2, V.precio AS precio2 FROM Viajes AS V, VDO, Ciudades AS C1, Ciudades AS C2 WHERE V.vid = _v2.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD_d_cid = C2.cid) LOOP
                        INSERT INTO I VALUES(itinerario, _datos.origen2, _datos.destino2, _datos.medio2, _datos.hora2, _datos.duracion2, _datos.precio2);
                        itinerario = itinerario + 1;
                    END LOOP;
                END CASE;
            END LOOP;
        ElSE
            FOR _datos IN (SELECT C1.ciudad AS origen1, C2.ciudad AS destino1, V.medio AS medio1, V.hora_salida AS hora1, V.duracion AS duracion1, V.precio AS precio1 FROM Viajes AS V, VDO, Ciudades AS C1, Ciudades AS C2 WHERE V.vid = _v1.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD_d_cid = C2.cid) LOOP
                INSERT INTO I VALUES(itinerario, _datos.origen1, _datos.destino1, _datos.medio1, _datos.hora1, _datos.duracion1, _datos.precio1);
                itinerario = itinerario + 1;
            END LOOP;
        END CASE;
    END LOOP;

    RETURN QUERY SELECT * FROM I;
RETURN;
END;
$$ LANGUAGE plpgsql;