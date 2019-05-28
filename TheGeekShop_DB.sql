-- Proyecto TheGeekStore --
-----------------------
--- Cesar Rebollar ---
-----------------------

CREATE USER admin_shop WITH ENCRYPTED PASSWORD 'mishop';
CREATE DATABASE geekshop WITH OWNER admin_shop;

-- conecct: psql -h 127.0.0.1 -d geekshop -U admin_shop
-- pass: mishop

CREATE TABLE usuarios(
	idUsuario		serial 			NOT NULL,
	nombre			varchar(30)		NOT NULL,
	aPaterno		varchar(30)		NOT NULL,
	usuarioNombre	varchar(30)		NOT NULL,
	correo			varchar(60)		NOT NULL,
	contraseña		varchar(32)		NOT NULL,
	rol				varchar(10)		NULL,
	
	CONSTRAINT pkUsuario
	PRIMARY KEY(idUsuario)
);

CREATE TABLE productos(
	idProducto		serial 			NOT NULL,
	nombre			varchar(60)		NOT NULL,
	precio			decimal(20,2)	NOT NULL,
	descripcion		TEXT 			NOT NULL,
	imagen			varchar(255)	NOT NULL,
	
	CONSTRAINT pkProducto
	PRIMARY KEY(idProducto) 
);

CREATE TABLE ventas(
	idVenta				serial 			NOT NULL,
	claveTransaccion	varchar(250)	NOT NULL,
	datosP				TEXT 			NOT NULL,
	fecha				timestamp		NOT NULL,
	correo				varchar(5000)	NOT NULL,
	total				decimal(60,2)	NOT NULL,
	status				varchar(200)	NOT NULL,
	usuarioNombre		varchar(30)		NULL,

	CONSTRAINT pkVenta
	PRIMARY KEY(idVenta)
);

CREATE TABLE detalleVenta(
	idDetalleV			serial 			NOT NULL,
	idVenta				int 			NOT NULL,
	idProducto			int 	 		NOT NULL,
	precioUnitario		decimal(20,2)	NOT NULL,
	cantidad			int 			NOT NULL,
	descargado			int 			NOT NULL,
	usuario 			varchar(30)		NULL,

	CONSTRAINT pkDetalle
	PRIMARY KEY(idDetalleV)
);

ALTER TABLE detalleVenta
ADD CONSTRAINT fkDetalleVenta
FOREIGN KEY(idVenta)
REFERENCES ventas(idVenta)
ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE detalleVenta
ADD CONSTRAINT fkDetalleProducto
FOREIGN KEY(idProducto)
REFERENCES productos(idProducto)
ON DELETE CASCADE ON UPDATE CASCADE; 


-- Privilegios --
GRANT INSERT, UPDATE, DELETE ON tipoUsuario to admin_shop;
GRANT usage ON tipoUsuario_idTipoUsuario_seq  to admin_shop;

GRANT INSERT, UPDATE, DELETE ON usuarios to admin_shop;
GRANT usage ON usuarios_idusuario_seq  to admin_shop;

GRANT INSERT, UPDATE, DELETE ON productos to admin_shop;
GRANT usage ON productos_idproducto_seq  to admin_shop;

GRANT INSERT, UPDATE, DELETE ON ventas to admin_shop;
GRANT usage ON ventas_idventa_seq  to admin_shop;

GRANT INSERT, UPDATE, DELETE ON detalleVenta to admin_shop;
GRANT usage ON detalleventa_iddetallev_seq  to admin_shop;