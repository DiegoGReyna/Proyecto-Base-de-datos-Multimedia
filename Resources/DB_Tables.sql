--CREATED BY Diego Reyna & Edson Moreno


CREATE DATABASE IF NOT EXISTS NEWS_CENTER;

USE NEWS_CENTER;

CREATE TABLE IF NOT EXISTS USER_TYPES(
    `USER_TYPE_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla USER_TYPES",
    `DESCRIPTION` VARCHAR(200) NOT NULL COMMENT "Nombre del tipo de usuario",
    `CREATION_DATE` DATETIME NOT NULL COMMENT "Fecha de creacion del registro",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    PRIMARY KEY (USER_TYPE_ID)
);

CREATE TABLE IF NOT EXISTS USER_STATUS(
    `VALUE` VARCHAR(3) NOT NULL COMMENT "Valor del Status",
    `DESCRIPTION` VARCHAR(200) NOT NULL COMMENT "Nombre del status asignado al usuario",
    `CREATION_DATE` DATETIME NOT NULL COMMENT "Fecha de creacion del registro",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    PRIMARY KEY (`VALUE`)
);

CREATE TABLE IF NOT EXISTS USERS (
    `USER_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla USERS",
    `EMAIL` VARCHAR(200) NOT NULL COMMENT "Correo principal, con el se accede al sitio",
    `USER_PWD` VARCHAR(200) NOT NULL COMMENT "Contraseña para ingresar al sitio",
    `PROFILE_PIC` MEDIUMBLOB COMMENT "Foto de perfil del usuario",
    `USER_FULL_NAME` VARCHAR(200) COMMENT "Nombre completo del usuario",
    `STATUS` VARCHAR(3) DEFAULT 'A' COMMENT "Status del usuario",
    `USER_TYPE_ID` INT NOT NULL COMMENT "Llave primaria de la tabla USER_TYPES",
    `CREATION_DATE` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "Fecha de creacion del registro",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    PRIMARY KEY (USER_ID),
    FOREIGN KEY (STATUS) REFERENCES USER_STATUS(VALUE),
    FOREIGN KEY (USER_TYPE_ID) REFERENCES USER_TYPES(USER_TYPE_ID)
);

CREATE TABLE IF NOT EXISTS COLORS_FOR_SECTIONS(
	`COLOR_FOR_SECTIONS_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id del color para la seccion",
    `HEXADECIMAL` VARCHAR(9) NOT NULL COMMENT "Valor hexadecimal del color",
    PRIMARY KEY(COLOR_FOR_SECTIONS_ID)
);

CREATE TABLE IF NOT EXISTS SECTIONS(
	`SECTION_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id de la seccion",
    `SECTION_NAME` VARCHAR(50) NOT NULL COMMENT "Nombre de la seccion",
    `DESCRIPTION` VARCHAR(200) NOT NULL COMMENT "Descripcion de la sección",
    `ORDER_OF_SECTIONS` VARCHAR(200) NOT NULL COMMENT "Nombre de la sección",
    `FK_COLOR_ID` INT NOT NULL COMMENT "Id del color de la seccion de la noticia",
    `IS_ACTIVE` BOOL DEFAULT TRUE COMMENT "Baja lógica de la sección de noticias",
    PRIMARY KEY (SECTION_ID),
    FOREIGN KEY (FK_COLOR_ID) REFERENCES COLORS_FOR_SECTIONS(COLOR_FOR_SECTIONS_ID)
);

CREATE TABLE IF NOT EXISTS NEWS_STATUS(
	`VALUE` VARCHAR(3) NOT NULL COMMENT "Valor del Status",
    `DESCRIPTION` VARCHAR(200) NOT NULL COMMENT "Nombre del status asignada a la noticia",
    `CREATION_DATE` DATETIME NOT NULL COMMENT "Fecha de creacion del registro",
    `IS_ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    PRIMARY KEY (`VALUE`)
);

CREATE TABLE IF NOT EXISTS NEWS_RELEVANCE(
	`RELEVANCE_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id de la relevancia de la noticia",
    `NAME_RELEVANCE` VARCHAR(30) NOT NULL COMMENT "Nombre de la relevancia asignada a la noticia",
    `DESCRIPTION_RELEVANCE` VARCHAR(100) NOT NULL COMMENT "Descripción de la relevancia de la noticia",
    PRIMARY KEY (`RELEVANCE_ID`)
);

CREATE TABLE IF NOT EXISTS NEWS(
	`NEWS_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id de la noticia",
    `NEWS_TITLE` VARCHAR(50) NOT NULL COMMENT "Titulo de la noticia",
    `STATUS` INT NOT NULL COMMENT "FK que indica el status de la noticia",
    `DESCRIPTION` VARCHAR(100) NOT NULL COMMENT "Descripcion de la noticia",
    `TEXT` VARCHAR(200) NOT NULL COMMENT "Texto de la noticia",
	`VIEWSCOUNT` INT DEFAULT 0 COMMENT "Contador de visitas",
	`FK_RELEVANCE` INT NOT NULL COMMENT "Relevancia de la noticia",
    `FK_REPORTERO_ID` INT NOT NULL COMMENT "FK para la información del reportero",
	`DATE_INCIDENT` DATETIME NOT NULL COMMENT "Fecha de cuando ocurrio el suceso",
    `DATE_RELEASE` DATETIME COMMENT "Null, porque se actualizara cuando se publique la noticia",
    PRIMARY KEY(NEWS_ID),
    FOREIGN KEY (FK_REPORTERO_ID) REFERENCES USERS(USER_ID),
	FOREIGN KEY (FK_RELEVANCE) REFERENCES NEWS_RELEVANCE(RELEVANCE_ID)
);

CREATE TABLE IF NOT EXISTS KEY_WORDS(
	`KEY_WORDS_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id de la palabra clave de la noticia",
	`FK_NEWS_ID` INT NOT NULL COMMENT "Id de la noticia que le gusto",
    `KEY_WORD_TEXT` VARCHAR(25) NOT NULL COMMENT "Palabra clave para la noticia",
    PRIMARY KEY(KEY_WORDS_ID),
    FOREIGN KEY (FK_NEWS_ID) REFERENCES NEWS(NEWS_ID)
);

CREATE TABLE IF NOT EXISTS LIKES(
	`LIKES_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id del like, para no repetir like por usuario",
	`FK_NEWS_ID` INT NOT NULL COMMENT "Id de la noticia que le gusto",
    `FK_USER_ID` INT NOT NULL COMMENT "Id del usuario que dio like",
    PRIMARY KEY(LIKES_ID),
    FOREIGN KEY (FK_USER_ID) REFERENCES USERS(USER_ID),
    FOREIGN KEY (FK_NEWS_ID) REFERENCES NEWS(NEWS_ID)
);

CREATE TABLE IF NOT EXISTS COMMENTS(
	`COMMENTS_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id del comentario del usuario",
	`FK_NEWS_ID` INT NOT NULL COMMENT "Id de la noticia que comento",
    `FK_USER_ID` INT NOT NULL COMMENT "Id del usuario que comento",
    `COMMENT` VARCHAR(150) NOT NULL COMMENT "Comentario del usuario a la noticia",
    `DATE_OF_COMMENT` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "Dia de la creación del comentario",
    `IS_ACTIVE` BOOL DEFAULT TRUE COMMENT "Activo, para el borrado lógico",
    PRIMARY KEY(COMMENTS_ID),
    FOREIGN KEY (FK_USER_ID) REFERENCES USERS(USER_ID),
    FOREIGN KEY (FK_NEWS_ID) REFERENCES NEWS(NEWS_ID)
);

CREATE TABLE IF NOT EXISTS COMMENTS_RESPONSE(
	`RESPONCES_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id de la respuesta del comentario del usuario",
    `FK_USER_ID` INT NOT NULL COMMENT "Id del usuario que respondio",
    `RESPONSE` VARCHAR(150) NOT NULL COMMENT "Respuesta del usuario a la noticia",
    `COMMENTS_ID` INT NOT NULL COMMENT "Id del comentario respondido",
    `DATE_OF_RESPONSE` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT "Dia de la creación de la respuesta",
    `IS_ACTIVE` BOOL DEFAULT TRUE COMMENT "Activo, para el borrado lógico",
    PRIMARY KEY(RESPONCES_ID),
    FOREIGN KEY (FK_USER_ID) REFERENCES USERS(USER_ID),
    FOREIGN KEY (COMMENTS_ID) REFERENCES COMMENTS(COMMENTS_ID)
);

CREATE TABLE IF NOT EXISTS MULTIMEDIA(
	`MULTIMEDIA_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id del contenido multimedia",
	`FK_NEWS_ID` INT NOT NULL COMMENT "Id de la noticia a la quepertenece el contenido",
    `PATH_MULTIMEDIA` VARCHAR(250) NOT NULL COMMENT "Direccion del archivo",
    `TYPE` VARCHAR(2) NOT NULL COMMENT "Inicial del tipo de archivo V o I",
    PRIMARY KEY(MULTIMEDIA_ID),
    FOREIGN KEY (FK_NEWS_ID) REFERENCES NEWS(NEWS_ID)
);

CREATE TABLE IF NOT EXISTS SECTIONS_FOR_NEWS(
	`SECTION_FOR_NEWS_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id de la seccion para la noticia",
    `FK_SECTION_ID` INT NOT NULL COMMENT "Información de la seccion",
    `FK_NEWS_ID` INT NOT NULL COMMENT "Id de la noticia a la que corresponde la sección",
    PRIMARY KEY (SECTION_FOR_NEWS_ID),
    FOREIGN KEY (FK_SECTION_ID) REFERENCES SECTIONS(SECTION_ID),
    FOREIGN KEY (FK_NEWS_ID) REFERENCES NEWS(NEWS_ID)
);

CREATE TABLE IF NOT EXISTS ADRESS(
	`ADRESS_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Id de la direccion de la noticia",
    `COUNTRY` VARCHAR(30) COMMENT "Pais donde sucedio la noticia",
    `STATE` VARCHAR(50) COMMENT "Estado donde sucedio la noticia",
    `MUNICIPIO` VARCHAR(50) COMMENT "Municipio donde sucedio la noticia",
    `SUBURB` VARCHAR(50) COMMENT "Calle donde sucedio la noticia",
    `FK_NEWS_ADDRES_ID` INT NOT NULL COMMENT "Id de la noticia a la que corresponde la direccion",
    PRIMARY KEY (ADRESS_ID),
    FOREIGN KEY (FK_NEWS_ADDRES_ID) REFERENCES NEWS(NEWS_ID)
);
select * FROM users;

insert into user_types(DESCRIPTION,CREATION_DATE,ACTIVE) VALUES('Admin', current_date(),1);

insert into user_status(VALUE, DESCRIPTION,CREATION_DATE,ACTIVE) VALUES('A', 'Activo', current_date(),1);
