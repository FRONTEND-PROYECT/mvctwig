
/** grupos de usuarios creados */
INSERT INTO public.grupo(descripcion, estado) VALUES ('ADMINISTRADOR', 'T');
INSERT INTO public.grupo(descripcion, estado) VALUES ('ALMACENERO', 'T');
INSERT INTO public.grupo(descripcion, estado) VALUES ('REPORTES', 'T');

/*insetando las acciones que se crearan*/
INSERT INTO public.accion(codigo, descripcion, estado) VALUES ('1111', 'Nuevo', 'T');
INSERT INTO public.accion(codigo, descripcion, estado) VALUES ('2222', 'Modificar', 'T');
INSERT INTO public.accion(codigo, descripcion, estado) VALUES ('3333', 'Eliminar', 'T');
INSERT INTO public.accion(codigo, descripcion, estado) VALUES ('4444', 'Listar', 'T');


/* insertando los modulos */
INSERT INTO public.modulo(descripcion, nombrefile, idmenu, estado)VALUES ('Actividades Improductivas', 'Improductiva', 'idFImproductiva', 'T');
INSERT INTO public.modulo(descripcion, nombrefile, idmenu, estado)VALUES ('Orden de Trabajo', 'OrdenTrabajo', 'idFOt', 'T');
INSERT INTO public.modulo(descripcion, nombrefile, idmenu, estado)VALUES ('Gestion de Personal', 'Personal', 'idFPersonal', 'T');
INSERT INTO public.modulo(descripcion, nombrefile, idmenu, estado)VALUES ('Items Obras', 'ItemObra', 'idFProductiva', 'T');
INSERT INTO public.modulo(descripcion, nombrefile, idmenu, estado)VALUES ('Equipo Pesado', 'Equipo', 'idFEquipo', 'T');
INSERT INTO public.modulo(descripcion, nombrefile, idmenu, estado)VALUES ('Admi. Gestiones', 'Gestion', 'idFGestion', 'T');
INSERT INTO public.modulo(descripcion, nombrefile, idmenu, estado)VALUES ('Transferencia de Personal', 'TransfPersonal', 'idFTransfPersonal', 'T');
INSERT INTO public.modulo(descripcion, nombrefile, idmenu, estado)VALUES ('Transferencia de Equipos', 'TransfEquipo', 'idFTransfEquipo', 'T');

select * from public.modulo;
select * from public.grupo;
select * from public.accion;
select * from public.spgestion;
/*insertamos el modulos para el grupo administrador = 1*/

INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 1, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 1, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 1, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 1, 4, '2016-12-17');

INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 2, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 2, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 2, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 2, 4, '2016-12-17');

INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 3, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 3, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 3, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 3, 4, '2016-12-17');

INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 4, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 4, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 4, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 4, 4, '2016-12-17');

INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 5, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 5, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 5, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 5, 4, '2016-12-17');

INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 6, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 6, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 6, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 6, 4, '2016-12-17');

INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 7, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 7, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 7, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 7, 4, '2016-12-17');

INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 8, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 8, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 8, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (1, 8, 4, '2016-12-17');

/*insertamos los privilegios del almacenero*/
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (2, 8, 1, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (2, 8, 2, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (2, 8, 3, '2016-12-17');
INSERT INTO public.modulogrupo(fkgrupo, fkmodulo, fkaccion, fechainstall)VALUES (2, 8, 4, '2016-12-17');

/* es un usuario administrador*/
INSERT INTO public.usuario(nickname, nombrecompleto, apellidos, email, password, fkgrupousuario) VALUES ('limbert', 'Alex Limbert', 'Yalusqui', 'limbert@hotmail.com', 'limbert', 1);
/* un usuario almacenero*/
INSERT INTO public.usuario(nickname, nombrecompleto, apellidos, email, password, fkgrupousuario) VALUES ('cabrera', 'Gilber', 'Cabrera', 'cabrera@hotmail.com', 'cabrera', 2);
