/* ---------------------------------------------------- */
/*  Generated by Enterprise Architect Version 12.1 		*/
/*  Created On : 17-dic.-2016 12:15:27 p. m. 				*/
/*  DBMS       : PostgreSQL 						*/
/* ---------------------------------------------------- */

/* Drop Sequences for Autonumber Columns */

DROP SEQUENCE IF EXISTS accion_pkaccion_seq
;

DROP SEQUENCE IF EXISTS grupo_pkgrupo_seq
;

DROP SEQUENCE IF EXISTS modulo_pkmodulo_seq
;

DROP SEQUENCE IF EXISTS usuario_pkusuario_seq
;

/* Drop Tables */

DROP TABLE IF EXISTS Accion CASCADE
;

DROP TABLE IF EXISTS Grupo CASCADE
;

DROP TABLE IF EXISTS Modulo CASCADE
;

DROP TABLE IF EXISTS ModuloGrupo CASCADE
;

DROP TABLE IF EXISTS Usuario CASCADE
;

/* Create Tables */

CREATE TABLE Accion
(
	pkAccion integer NOT NULL   DEFAULT NEXTVAL(('"accion_pkaccion_seq"'::text)::regclass),
	codigo varchar(10),
	descripcion varchar(25),
	estado char(1)
)
;

CREATE TABLE Grupo
(
	pkGrupo integer NOT NULL   DEFAULT NEXTVAL(('"grupo_pkgrupo_seq"'::text)::regclass),
	descripcion varchar(50),
	estado char(1) NOT NULL
)
;

CREATE TABLE Modulo
(
	pkModulo integer NOT NULL   DEFAULT NEXTVAL(('"modulo_pkmodulo_seq"'::text)::regclass),
	descripcion varchar(25),
	nombreFile varchar(50),
	idMenu varchar(25),
	estado char(1)
)
;

CREATE TABLE ModuloGrupo
(
	fkGrupo integer NOT NULL,
	fkModulo integer NOT NULL,
	fkAccion integer NOT NULL,
	fechaInstall date
)
;

CREATE TABLE Usuario
(
	pkUsuario integer NOT NULL   DEFAULT NEXTVAL(('"usuario_pkusuario_seq"'::text)::regclass),
	nickName varchar(25),
	nombreCompleto varchar(25),
	apellidos varchar(25),
	email varchar(25),
	password varchar(25),
	fkGrupoUsuario integer NOT NULL
)
;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE Accion ADD CONSTRAINT PK_Accion
	PRIMARY KEY (pkAccion)
;

ALTER TABLE Grupo ADD CONSTRAINT PK_Grupo
	PRIMARY KEY (pkGrupo)
;

ALTER TABLE Modulo ADD CONSTRAINT PK_Modulo
	PRIMARY KEY (pkModulo)
;

ALTER TABLE ModuloGrupo ADD CONSTRAINT PK_ModuloGrupo
	PRIMARY KEY (fkGrupo,fkModulo,fkAccion)
;

CREATE INDEX IXFK_ModuloGrupo_Accion ON ModuloGrupo (fkAccion ASC)
;

CREATE INDEX IXFK_ModuloGrupo_Grupo ON ModuloGrupo (fkGrupo ASC)
;

CREATE INDEX IXFK_ModuloGrupo_Modulo ON ModuloGrupo (fkModulo ASC)
;

ALTER TABLE Usuario ADD CONSTRAINT PK_Usuario
	PRIMARY KEY (pkUsuario)
;

CREATE INDEX IXFK_Usuario_Grupo ON Usuario (fkGrupoUsuario ASC)
;

/* Create Foreign Key Constraints */

ALTER TABLE ModuloGrupo ADD CONSTRAINT FK_ModuloGrupo_Accion
	FOREIGN KEY (fkAccion) REFERENCES Accion (pkAccion) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE ModuloGrupo ADD CONSTRAINT FK_ModuloGrupo_Grupo
	FOREIGN KEY (fkGrupo) REFERENCES Grupo (pkGrupo) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE ModuloGrupo ADD CONSTRAINT FK_ModuloGrupo_Modulo
	FOREIGN KEY (fkModulo) REFERENCES Modulo (pkModulo) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE Usuario ADD CONSTRAINT FK_Usuario_Grupo
	FOREIGN KEY (fkGrupoUsuario) REFERENCES Grupo (pkGrupo) ON DELETE No Action ON UPDATE No Action
;

/* Create Table Comments, Sequences for Autonumber Columns */

CREATE SEQUENCE accion_pkaccion_seq INCREMENT 1 START 1
;

CREATE SEQUENCE grupo_pkgrupo_seq INCREMENT 1 START 1
;

CREATE SEQUENCE modulo_pkmodulo_seq INCREMENT 1 START 1
;

CREATE SEQUENCE usuario_pkusuario_seq INCREMENT 1 START 1
;
