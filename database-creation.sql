create database ritmodecopas;
use ritmodecopas;

create table Genero(
	cod_gen int primary key,
	nombre varchar(255)
);

create table Ciudad(
	cod_ciu int primary key,
	nombre varchar(255)
);

create table Usuario(
	cod_usu int primary key auto_increment,

	correo varchar(255),
	contrasena varchar(255),
	tipo_usu int,
	
	imagen varchar(255),
	nombre varchar(255),
	cod_ciu int,
	cod_gen int,
	fecha_nacimiento date,
	direccion varchar(255),
	telefono int,
	aforo int,
	nombre_grupo varchar(255),
	token varchar(30),
foreign key (cod_ciu) references Ciudad(cod_ciu),
foreign key (cod_gen) references Genero(cod_gen)
);

create table Votacion_Usuario(
	cod_usu_fan int,
	cod_usu_mus int,
	puntuacion int,
	comentario varchar(255),
primary key (cod_usu_fan, cod_usu_mus),
foreign key (cod_usu_fan) references Usuario(cod_usu),
foreign key (cod_usu_mus) references Usuario(cod_usu)
);

create table Concierto(
	cod_con int primary key auto_increment,
	cod_usu_local int,
	cod_usu_mus int,
	cod_gen int,
	nombre varchar(255),
	fecha datetime,
	estado int,
	comentarios varchar(255),
foreign key (cod_usu_local) references Usuario(cod_usu),
foreign key (cod_gen) references Genero(cod_gen),
foreign key (cod_usu_mus) references Usuario(cod_usu)
);

create table Votacion_Concierto(
	cod_usu_fan int,
	cod_con int,
	puntuacion int,
	comentario varchar(255),
primary key (cod_usu_fan, cod_con),
foreign key (cod_usu_fan) references Usuario(cod_usu),
foreign key (cod_con) references Concierto(cod_con)
);
create table Musico_Apunta(
	cod_usu_mus int,
	cod_con int,
	estado int,
primary key (cod_usu_mus, cod_con),
foreign key (cod_usu_mus) references Usuario(cod_usu),
foreign key (cod_con) references Concierto(cod_con));




INSERT INTO Ciudad (cod_ciu, nombre)
VALUES
	(2,'Albacete'),
	(3,'Alicante/Alacant'),
	(4,'Almería'),
	(1,'Araba/Álava'),
	(33,'Asturias'),
	(5,'Ávila'),
	(6,'Badajoz'),
	(7,'Balears, Illes'),
	(8,'Barcelona'),
	(48,'Bizkaia'),
	(9,'Burgos'),
	(10,'Cáceres'),
	(11,'Cádiz'),
	(39,'Cantabria'),
	(12,'Castellón/Castelló'),
	(51,'Ceuta'),
	(13,'Ciudad Real'),
	(14,'Córdoba'),
	(15,'Coruña, A'),
	(16,'Cuenca'),
	(20,'Gipuzkoa'),
	(17,'Girona'),
	(18,'Granada'),
	(19,'Guadalajara'),
	(21,'Huelva'),
	(22,'Huesca'),
	(23,'Jaén'),
	(24,'León'),
	(27,'Lugo'),
	(25,'Lleida'),
	(28,'Madrid'),
	(29,'Málaga'),
	(52,'Melilla'),
	(30,'Murcia'),
	(31,'Navarra'),
	(32,'Ourense'),
	(34,'Palencia'),
	(35,'Palmas, Las'),
	(36,'Pontevedra'),
	(26,'Rioja, La'),
	(37,'Salamanca'),
	(38,'Santa Cruz de Tenerife'),
	(40,'Segovia'),
	(41,'Sevilla'),
	(42,'Soria'),
	(43,'Tarragona'),
	(44,'Teruel'),
	(45,'Toledo'),
	(46,'Valencia/València'),
	(47,'Valladolid'),
	(49,'Zamora'),
	(50,'Zaragoza');

INSERT INTO Genero (cod_gen, nombre)
VALUES
	(1, "Blues"),
	(2, "Música clásica"),
	(3, "Dance"),
	(4, "Dembow"),
	(5, "Disco"),
	(6, "Música electrónica"),
	(7, "Hip Hop"),
	(8, "Jazz"),
	(9, "Reggae"),
	(10, "Reguetón"),
	(11, "Soul"),
	(12, "Rock"),
	(13, "Rock Alternativo"),
	(14, "Metal Alternativo"),
	(15, "Thrash Metal"),
	(16, "Punk Rock"),
	(17, "House"),
	(18, "Indie Rock"),
	(19, "Ninguno");

INSERT INTO `Usuario` (`cod_usu`, `correo`, `contrasena`, `tipo_usu`, `imagen`, `nombre`, `cod_ciu`, `cod_gen`, `fecha_nacimiento`, `direccion`, `telefono`, `aforo`, `nombre_grupo`, `token`) VALUES


		(1, 'local1@local1.com', '$2y$08$A2daw3nKurd1st4nyArdaueD6HEf8Ej/HCQRXvJ7VKF9exfpi5Y0e', 1, NULL, 'Manolo Local', 5, 19, NULL, 'Direccion Local 1', 645824546, 85, NULL, NULL),
		(2, 'local2@local2.com', '$2y$08$A2daw3nKurd1st4nyArdaueD6HEf8Ej/HCQRXvJ7VKF9exfpi5Y0e', 1, NULL, 'Fulano Local', 5, 19, NULL, 'Direccion Local 1', 456753356, 54, NULL, NULL),
		(3, 'local3@local3.com', '$2y$08$A2daw3nKurd1st4nyArdaueD6HEf8Ej/HCQRXvJ7VKF9exfpi5Y0e', 1, NULL, 'Paloma Local', 5, 19, NULL, 'Direccion Local 1', 935452864, 110, NULL, NULL),


		(4, 'musico1@musico1.com', '$2y$08$A2daw3nKurd1st4nyArdau7vDEPpfKjdCEa01J/4th4zMbH9HUUr.', 2, NULL, 'Alfredo Musico', 48, 5, NULL, NULL, 2147483647, NULL, 'Musico Banda Alfredo', NULL),
		(5, 'musico2@musico2.com', '$2y$08$A2daw3nKurd1st4nyArdau7vDEPpfKjdCEa01J/4th4zMbH9HUUr.', 2, NULL, 'Roc Musico', 48, 9, NULL, NULL, 2147483647, NULL, 'Musico Banda Roc', NULL),
		(6, 'musico3@musico3.com', '$2y$08$A2daw3nKurd1st4nyArdau7vDEPpfKjdCEa01J/4th4zMbH9HUUr.', 2, NULL, 'David Musico', 48, 5, NULL, NULL, 2147483647, NULL, 'Musico Banda David', NULL),


		(7, 'fan@fan.com', '$2y$08$A2daw3nKurd1st4nyArdauR2jF8CJgEyDe4e1YyaQwgAK4LTD2RR.', 0, NULL, 'Fan loco 1', 6, 14, '2015-05-28', NULL, NULL, NULL, NULL, NULL),
		(8, 'fan@fan.com', '$2y$08$A2daw3nKurd1st4nyArdauR2jF8CJgEyDe4e1YyaQwgAK4LTD2RR.', 0, NULL, 'Fan especial 2', 6, 14, '2015-05-28', NULL, NULL, NULL, NULL, NULL),
		(9, 'fan@fan.com', '$2y$08$A2daw3nKurd1st4nyArdauR2jF8CJgEyDe4e1YyaQwgAK4LTD2RR.', 0, NULL, 'Fan interesante 3', 6, 14, '2015-05-28', NULL, NULL, NULL, NULL, NULL);



		INSERT INTO `Concierto` (`cod_con`, `cod_usu_local`, `cod_usu_mus`, `cod_gen`, `nombre`, `fecha`, `estado`, `comentarios`) VALUES
			(1, 1, 4, 5, 'Disco a tope 1', '2015-06-19 16:00:00', 1, 'Será una pasada!'),
			(2, 1, NULL, 4, 'Dembow yatusabe', '2014-08-18 16:00:00', 0, 'Prepárate para lo mejor.'),
			(3, 2, 5, 9, 'Reaggue loko', '2015-06-18 16:00:00', 1, 'Será interesante'),
			(4, 2, NULL, 5, 'Pasada tío!', '2015-06-18 16:00:00', 0, 'Recuerda, +18'),
			(5, 3, NULL, 5, 'Disco a tope 2', '2015-06-18 16:00:00', 0, 'Cubatas a 3€'),
			(6, 3, 6, 5, 'Disco a tope 3', '2015-06-18 16:00:00', 1, 'Solo mayores de 99 acompañados por sus padres');

		INSERT INTO `Musico_Apunta` (`cod_usu_mus`, `cod_con`, `estado`) VALUES
			(4, 1, 1),
			(5, 3, 1),
			(6, 6, 1);